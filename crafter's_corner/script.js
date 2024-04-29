document.addEventListener('DOMContentLoaded', function() {
    const popupBox = document.querySelector('.popup-box');
    const closeBtn = document.querySelector('.close-btn');
  
    // Show the pop-up box when the page is loaded
    popupBox.style.display = 'block';
  
    // Close the pop-up box when the close button is clicked
    closeBtn.addEventListener('click', function() {
      popupBox.style.display = 'none';
    });
  });
// Function to fetch comments from the server
function fetchComments() {
  fetch('comments.php')
      .then(response => response.json())
      .then(data => {
          const commentsDiv = document.getElementById('comments');
          commentsDiv.innerHTML = '';
          data.forEach(comment => {
              commentsDiv.innerHTML += `<div><strong>${comment.name}:</strong> ${comment.message}</div>`;
          });
      })
      .catch(error => console.error('Error fetching comments:', error));
}

// Function to handle form submission
document.getElementById('commentForm').addEventListener('submit', function(event) {
  event.preventDefault();
  const name = document.getElementById('name').value;
  const message = document.getElementById('message').value;

  if (name.trim() === '' || message.trim() === '') {
      alert('Please enter your name and comment.');
      return;
  }

  fetch('add_comment.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify({ name, message })
  })
  .then(response => {
      if (response.ok) {
          document.getElementById('name').value = '';
          document.getElementById('message').value = '';
          fetchComments(); // Fetch comments again after adding a new one
      } else {
          throw new Error('Failed to add comment.');
      }
  })
  .catch(error => console.error('Error adding comment:', error));
});

// Fetch comments initially and every 5 seconds
fetchComments();
setInterval(fetchComments, 5000);

  