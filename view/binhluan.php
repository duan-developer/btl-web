<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống bình luận</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #333;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #4CAF50;
        }

        .comment-system {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .comment-form {
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }

        .comment-form label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .comment-form input[type="text"],
        .comment-form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            resize: none;
        }

        .comment-form textarea {
            height: 120px;
        }

        .comment-form button {
            background-color: #4CAF50;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .comment-form button:hover {
            background-color: #45a049;
        }

        .comment-list {
            padding: 20px;
        }

        .comment-list h2 {
            margin-bottom: 20px;
            color: #4CAF50;
            font-size: 20px;
        }

        .comment {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .comment strong {
            font-size: 16px;
            color: #333;
        }

        .comment em {
            font-size: 14px;
            color: #777;
            margin-left: 5px;
        }

        .comment p {
            margin-top: 8px;
            line-height: 1.5;
            font-size: 15px;
            color: #444;
        }
    </style>
</head>
<body>
    <h1>Hệ thống bình luận</h1>

    <div class="comment-system">
        <!-- Form bình luận -->
        <div class="comment-form">
            <form method="post" action="">
                <label for="username">Tên của bạn:</label>
                <input type="text" id="username" name="username" required placeholder="Nhập tên của bạn">
                
                <label for="comment">Nội dung bình luận:</label>
                <textarea id="comment" name="comment" required placeholder="Viết bình luận của bạn ở đây..."></textarea>
                
                <button type="submit">Gửi bình luận</button>
            </form>
        </div>

        <!-- Danh sách bình luận -->
        <div class="comment-list">
            <h2>Bình luận gần đây</h2>
            <?php
            // Kiểm tra nếu file dữ liệu không tồn tại, tạo file trống
            $data_file = 'comments.txt';
            if (!file_exists($data_file)) {
                file_put_contents($data_file, '');
            }

            // Xử lý khi người dùng gửi bình luận
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = htmlspecialchars($_POST["username"]);
                $comment = htmlspecialchars($_POST["comment"]);

                // Thời gian bình luận
                $timestamp = date("d/m/Y H:i:s");

                // Lưu bình luận vào file
                $new_comment = "$username|$timestamp|$comment\n";
                file_put_contents($data_file, $new_comment, FILE_APPEND);
            }

            // Đọc và hiển thị các bình luận từ file
            $comments = file($data_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach (array_reverse($comments) as $line) {
                list($username, $timestamp, $comment) = explode('|', $line);
                echo "<div class='comment'>";
                echo "<strong>$username</strong> <em>($timestamp)</em>";
                echo "<p>$comment</p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
