const express = require('express');
const session = require('express-session');
const bodyParser = require('body-parser');
const flash = require('connect-flash');
const bcrypt = require('bcryptjs');
const path = require('path');

const app = express();
const PORT = process.env.PORT || 3000;

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));
app.use(express.static(path.join(__dirname, 'public')));
app.use(bodyParser.urlencoded({ extended: false }));
app.use(
  session({
    secret: process.env.SESSION_SECRET || 'super-secret-key',
    resave: false,
    saveUninitialized: false,
    cookie: { maxAge: 1000 * 60 * 60 }
  })
);
app.use(flash());

// In-memory user store for demo purposes only
const users = [
  {
    id: 1,
    username: 'demo',
    passwordHash: bcrypt.hashSync('demo123', 10),
    name: 'Demo User'
  }
];

function findUser(username) {
  return users.find((user) => user.username === username);
}

function ensureAuthenticated(req, res, next) {
  if (req.session.userId) {
    return next();
  }
  res.redirect('/login');
}

app.use((req, res, next) => {
  res.locals.currentUser = req.session.user;
  res.locals.error = req.flash('error');
  res.locals.success = req.flash('success');
  next();
});

app.get('/', (req, res) => {
  if (!req.session.userId) {
    return res.redirect('/login');
  }
  res.render('dashboard', { user: req.session.user });
});

app.get('/login', (req, res) => {
  if (req.session.userId) {
    return res.redirect('/');
  }
  res.render('login');
});

app.post('/login', (req, res) => {
  const { username, password } = req.body;
  const user = findUser(username);

  if (!user) {
    req.flash('error', 'Tên đăng nhập hoặc mật khẩu không đúng.');
    return res.redirect('/login');
  }

  const match = bcrypt.compareSync(password, user.passwordHash);
  if (!match) {
    req.flash('error', 'Tên đăng nhập hoặc mật khẩu không đúng.');
    return res.redirect('/login');
  }

  req.session.userId = user.id;
  req.session.user = { username: user.username, name: user.name };
  req.flash('success', 'Đăng nhập thành công!');
  res.redirect('/');
});

app.get('/logout', (req, res) => {
  req.session.destroy(() => {
    res.redirect('/login');
  });
});

app.get('/register', (req, res) => {
  if (req.session.userId) {
    return res.redirect('/');
  }
  res.render('register');
});

app.post('/register', (req, res) => {
  const { username, password, name } = req.body;

  if (!username || !password || !name) {
    req.flash('error', 'Vui lòng nhập đầy đủ thông tin.');
    return res.redirect('/register');
  }

  if (findUser(username)) {
    req.flash('error', 'Tên đăng nhập đã tồn tại.');
    return res.redirect('/register');
  }

  const passwordHash = bcrypt.hashSync(password, 10);
  const newUser = {
    id: users.length + 1,
    username,
    passwordHash,
    name
  };
  users.push(newUser);
  req.flash('success', 'Đăng ký thành công! Bạn có thể đăng nhập.');
  res.redirect('/login');
});

app.listen(PORT, () => {
  console.log(`Server is running at http://localhost:${PORT}`);
});
