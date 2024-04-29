const popupText = document.querySelector('.popup-content p');
fetch("https://type.fit/api/quotes")
  .then(function(response) {
    return response.json();
  })
  .then(function(data) {
    console.log(data);
    const { text } = data[Math.floor(Math.random() * data.length)];
    popupText.textContent = text;
  });
    
