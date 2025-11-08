const express = require('express');
const session = require('express-session');
const bcrypt = require('bcryptjs');
const fs = require('fs').promises;
const path = require('path');

const app = express();
const PORT = process.env.PORT || 3000;
const USERS_FILE = path.join(__dirname, 'data', 'users.json');

async function ensureUsersFile() {
  try {
    await fs.access(USERS_FILE);
  } catch (error) {
    await fs.mkdir(path.dirname(USERS_FILE), { recursive: true });
    await fs.writeFile(USERS_FILE, '[]', 'utf8');
  }
}

async function loadUsers() {
  await ensureUsersFile();
  const data = await fs.readFile(USERS_FILE, 'utf8');
  return JSON.parse(data);
}

async function saveUsers(users) {
  await fs.writeFile(USERS_FILE, JSON.stringify(users, null, 2), 'utf8');
}

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

app.use(express.static(path.join(__dirname, 'public')));
app.use(express.urlencoded({ extended: false }));
app.use(
  session({
    secret: process.env.SESSION_SECRET || 'change-this-secret',
    resave: false,
    saveUninitialized: false,
  })
);

app.use((req, res, next) => {
  res.locals.currentUser = req.session.user;
  res.locals.error = req.session.error;
  res.locals.message = req.session.message;
  delete req.session.error;
  delete req.session.message;
  next();
});

app.get('/', (req, res) => {
  res.render('home');
});

app.get('/register', (req, res) => {
  if (req.session.user) {
    req.session.message = 'Bạn đã đăng nhập rồi!';
    return res.redirect('/');
  }
  res.render('register');
});

app.post('/register', async (req, res) => {
  const { username, password, confirmPassword } = req.body;

  if (!username || !password || !confirmPassword) {
    req.session.error = 'Vui lòng nhập đầy đủ thông tin.';
    return res.redirect('/register');
  }

  if (password !== confirmPassword) {
    req.session.error = 'Mật khẩu xác nhận không khớp.';
    return res.redirect('/register');
  }

  try {
    const users = await loadUsers();
    const normalizedUsername = username.trim().toLowerCase();

    if (users.some((user) => user.username === normalizedUsername)) {
      req.session.error = 'Tên đăng nhập đã tồn tại.';
      return res.redirect('/register');
    }

    const passwordHash = await bcrypt.hash(password, 10);
    users.push({ username: normalizedUsername, passwordHash });
    await saveUsers(users);

    req.session.message = 'Đăng ký thành công! Hãy đăng nhập để tiếp tục.';
    res.redirect('/login');
  } catch (error) {
    console.error('Register error:', error);
    req.session.error = 'Có lỗi xảy ra. Vui lòng thử lại.';
    res.redirect('/register');
  }
});

app.get('/login', (req, res) => {
  if (req.session.user) {
    req.session.message = 'Bạn đã đăng nhập rồi!';
    return res.redirect('/');
  }
  res.render('login');
});

app.post('/login', async (req, res) => {
  const { username, password } = req.body;

  if (!username || !password) {
    req.session.error = 'Vui lòng nhập tên đăng nhập và mật khẩu.';
    return res.redirect('/login');
  }

  try {
    const users = await loadUsers();
    const normalizedUsername = username.trim().toLowerCase();
    const user = users.find((item) => item.username === normalizedUsername);

    if (!user) {
      req.session.error = 'Tên đăng nhập hoặc mật khẩu không chính xác.';
      return res.redirect('/login');
    }

    const match = await bcrypt.compare(password, user.passwordHash);

    if (!match) {
      req.session.error = 'Tên đăng nhập hoặc mật khẩu không chính xác.';
      return res.redirect('/login');
    }

    req.session.user = { username: normalizedUsername };
    req.session.message = 'Đăng nhập thành công!';
    res.redirect('/');
  } catch (error) {
    console.error('Login error:', error);
    req.session.error = 'Có lỗi xảy ra. Vui lòng thử lại.';
    res.redirect('/login');
  }
});

app.post('/logout', (req, res) => {
  req.session.destroy(() => {
    res.redirect('/');
  });
});

app.use((req, res) => {
  res.status(404).render('404');
});

app.listen(PORT, () => {
  console.log(`Server is running at http://localhost:${PORT}`);
});

