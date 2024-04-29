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
    <title>What I learned form my trip to Bali</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="blogpagedesign.css">
</head>
<body style=  "background-color: #f1eaf6">
    <div class="navbar">
        <div class="left-nav">
            <h2>Crafter's Corner</h2>
        </div>
        <div class="right-nav">
            <a href="Homepage.html">Home</a>
    
        </div>
    </div>

    <div class="container">
        <div class="heading">
            <h1>What I learned from my trip to Bali</h1>
        </div>
        <div class="date">
            <h3>By Sameeksha Singh</h3>
            <p>Monday Jan 20</p>
        </div>
        <br>
        <hr>
    </div>

    <div class="container2">
        <div class="content">
            <p>My journey to Bali was more than just a vacation; it was a transformative experience that left an indelible mark on my soul. From the moment I set foot on this enchanting island, I knew I was about to embark on a journey of self-discovery, cultural immersion, and spiritual awakening.<br>

                1. Embracing the Balinese Way of Life:
                One of the most profound lessons I learned in Bali was the art of living in harmony with nature and the community. The Balinese people's deep reverence for their land, their traditions, and each other was truly inspiring. I discovered the beauty of simplicity and the importance of gratitude in everyday life. Whether it was witnessing a traditional ceremony or sharing a meal with a local family, I learned that true happiness comes from connecting with others and embracing the present moment.<br>
                
                2. Finding Peace in Spiritual Reflection:
                Bali's spiritual energy is palpable, from the serene temples nestled in lush forests to the tranquil yoga retreats overlooking verdant rice terraces. During my time on the island, I found solace in moments of quiet reflection and meditation. I learned to listen to the whispers of my own heart and connect with a deeper sense of purpose. Whether it was attending a purification ritual at a sacred spring or practicing yoga at sunrise, Bali taught me the importance of nurturing my spiritual well-being and finding inner peace amidst life's chaos.<br>
                
                3. Embracing Diversity and Unity:
                Bali is a melting pot of cultures, where Hindu traditions blend seamlessly with Balinese rituals and modern influences. I was humbled by the openness and acceptance of the Balinese people towards people of all backgrounds. In Bali, I learned that diversity is not something to be feared, but celebrated. I discovered the beauty of cultural exchange and the power of unity in embracing our differences. Through conversations with locals and fellow travelers from around the world, I realized that we are all connected by our shared humanity, regardless of our nationality or beliefs.<br>
                
                4. Living in Harmony with Nature:
                Bali's breathtaking landscapes serve as a reminder of the fragility and beauty of our natural world. From the lush jungles and cascading waterfalls to the pristine beaches and volcanic peaks, I felt a deep sense of reverence for Mother Earth during my time on the island. I learned the importance of sustainable travel practices and the need to protect and preserve our planet for future generations. Whether it was participating in a beach cleanup or supporting eco-friendly businesses, Bali taught me that every small action makes a difference in creating a more sustainable and compassionate world.<br>
                
                Conclusion:
                My trip to Bali was more than just a vacation; it was a journey of self-discovery, cultural immersion, and spiritual awakening. From embracing the Balinese way of life to finding peace in spiritual reflection, Bali taught me valuable lessons that will stay with me for a lifetime. As I bid farewell to this magical island, I carry with me a renewed sense of gratitude, compassion, and connection to the world around me. Bali will always hold a special place in my heart as a place of growth, transformation, and endless possibility.
            
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
    <title>Discover Bali: The Island Paradise</title>
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
                <input type="hidden" id="postId" value="bali_blog_post_id_here">
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









