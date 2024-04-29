<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions, so instead, we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Banner</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="blogpagedesign.css">
</head>
<body style="background-color:  #f1eaf6;">
    <div class="navbar">
        <div class="left-nav">
            <h2>Crafter's Corner</h2>
        </div>
        <div class="right-nav">
            <a href="homepage.html">Home</a>
    
        </div>
    </div>
    

    <div class="container">
        
        <div class="heading">
            <h1>Will AI take over your programming career?</h1>
        </div>
        <div class="date">
            <h3>By Toshika Wagh</h3>
            <p>Monday Jan 20</p>
        </div>
        <br>
        <hr>
    </div>

    <div class="container2">
        <div class="content">
            <p>In recent years, the rise of Artificial Intelligence (AI) has sparked discussions and concerns about its potential to automate various jobs, including programming. As AI technologies advance, some individuals in the programming community worry about the future of their careers. Will AI become so advanced that it replaces human programmers altogether? In this blog post, we'll explore this question, debunk common myths surrounding AI and programming careers, and discuss the opportunities AI presents for programmers.<br> <br>

                Myth 1: AI Will Replace Human Programmers
                One of the most prevalent fears among programmers is that AI will eventually render their skills obsolete. While it's true that AI is increasingly capable of automating certain tasks traditionally performed by programmers, such as code generation and debugging, it's unlikely to completely replace human programmers. Programming involves creativity, problem-solving, and critical thinking—qualities that are difficult for AI to replicate entirely. Instead of viewing AI as a threat, programmers can leverage it as a tool to enhance their productivity and efficiency. <br> <br>
                
                Myth 2: AI Will Make Programming Jobs Scarce
                Another concern is that the widespread adoption of AI will lead to a decline in programming jobs. However, the demand for skilled programmers remains strong and is even expected to grow in the future. As technology continues to evolve, new programming languages, frameworks, and platforms emerge, creating opportunities for programmers to specialize and expand their skill sets. Additionally, AI itself requires programmers to develop, maintain, and optimize its algorithms and systems, leading to a demand for AI specialists and developers.<br> <br>
                
                Opportunity 1: Augmented Intelligence
                Rather than fearing AI, programmers can embrace the concept of augmented intelligence—collaboration between humans and AI to achieve better outcomes. AI tools can assist programmers in tasks such as code refactoring, testing automation, and data analysis, enabling them to focus on higher-level problem-solving and innovation. By leveraging AI as a complementary resource, programmers can enhance their productivity and deliver higher-quality software solutions. <br> <br>
                
                Opportunity 2: Specialization and Upskilling
                As AI technologies evolve, programmers have the opportunity to specialize in areas where human expertise is still indispensable. Fields such as machine learning, data science, cybersecurity, and cloud computing are experiencing rapid growth and demand for skilled professionals. By acquiring expertise in these specialized domains, programmers can position themselves for lucrative career opportunities and stay ahead in a rapidly evolving job market. Additionally, continuous learning and upskilling are essential for programmers to adapt to technological advancements and remain competitive. <br> <br>
                
                Conclusion:
                While the integration of AI into the programming landscape may bring about changes and challenges, it also offers exciting opportunities for growth and innovation. Rather than fearing the rise of AI, programmers can embrace it as a tool for augmenting their capabilities and advancing their careers. By staying informed, continuously learning, and adapting to new technologies, programmers can thrive in an AI-powered future and continue to make valuable contributions to the world of software development. So, will AI take over your programming career? Not if you're willing to evolve alongside it. <br> <br>
                
                Remember, the future is what we make of it, and with the right mindset and skills, programmers can continue to shape it for the better, with or without AI.
        </div>
    </div>
<hr>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Fascinating World of Artificial Intelligence</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="blogpagedesign.css">
    <style>
        /* Your existing CSS styles here */
        /* Style for the comment section */
        .comment-section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .comment {
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .comment .user-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .comment .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .comment .user-info h4 {
            margin: 0;
            color: #333;
        }
        .comment .comment-text {
            margin: 10px 0;
            color: #555;
        }
        .comment .comment-date {
            font-size: 0.8em;
            color: #888;
        }
    </style>
</head>
<body>

    <!-- Your existing website content -->

    <div class="comment-section">
        <h2>Comments</h2>
        <div class="comments"></div>
        <form class="comment-form">
            <h3>Leave a Comment</h3>
            <div class="user-info">
                <input type="hidden" id="postId" value="ai_blog_post_id_here">
                <h4><?= isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name'], ENT_QUOTES) : 'Anonymous' ?></h4>
            </div>
            <textarea id="comment-text" rows="4" placeholder="Write your comment here..." required></textarea>
            <button type="submit">Post Comment</button>
        </form>
    </div>

    <!-- Your existing website content -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const commentsContainer = document.querySelector(".comments");
            const commentForm = document.querySelector(".comment-form");

            // Function to save comments to localStorage
            function saveComments(postId, comments) {
                localStorage.setItem("comments_" + postId, JSON.stringify(comments));
            }

            // Function to load comments from localStorage
            function loadComments(postId) {
                const savedComments = localStorage.getItem("comments_" + postId);
                return savedComments ? JSON.parse(savedComments) : [];
            }

            // Function to create a new comment
            function createComment(postId, username, commentText) {
                const comment = document.createElement("div");
                comment.classList.add("comment");

                const userInfo = document.createElement("div");
                userInfo.classList.add("user-info");
                userInfo.innerHTML = `
                    <img src="user.png" alt="User Avatar">
                    <h4>${username}</h4>
                `;

                const commentTextElement = document.createElement("p");
                commentTextElement.classList.add("comment-text");
                commentTextElement.textContent = commentText;

                const commentDate = document.createElement("p");
                commentDate.classList.add("comment-date");
                commentDate.textContent = "Posted just now";

                comment.appendChild(userInfo);
                comment.appendChild(commentTextElement);
                comment.appendChild(commentDate);

                commentsContainer.prepend(comment);
            }

            // Load comments on page load
            const postId = document.getElementById("postId").value;
            const savedComments = loadComments(postId);
            savedComments.forEach(comment => {
                createComment(postId, comment.username, comment.commentText);
            });

            // Event listener for submitting the comment form
            commentForm.addEventListener("submit", function(event) {
                event.preventDefault();
                const postId = document.getElementById("postId").value;
                const username = document.querySelector(".user-info h4").textContent;
                const commentTextInput = document.getElementById("comment-text");
                const commentText = commentTextInput.value.trim();
                if (commentText) {
                    createComment(postId, username, commentText);
                    commentTextInput.value = "";

                    // Save new comment
                    const newComment = { username, commentText };
                    const savedComments = loadComments(postId);
                    savedComments.push(newComment);
                    saveComments(postId, savedComments);
                }
            });
        });
    </script>
</body>
</html>




