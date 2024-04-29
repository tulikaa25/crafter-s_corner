let currentStreak = parseInt(localStorage.getItem('currentStreak')) || 0;
let longestStreak = parseInt(localStorage.getItem('longestStreak')) || 0;
let lastActiveTime = parseInt(localStorage.getItem('lastActiveTime')) || new Date().getTime();
let intervalId;
let streakFlag = 0; // Flag to track if user was active for at least 30 seconds in the current minute
let bufferTime = 5; // Buffer time in seconds after the end of the minute

function updateStreakUI() {
    document.getElementById('currentStreakValue').innerText = currentStreak;
    document.getElementById('longestStreakValue').innerText = longestStreak;
}

function updateStreakInDatabase() {
    localStorage.setItem('currentStreak', currentStreak.toString());
    localStorage.setItem('longestStreak', longestStreak.toString());
    localStorage.setItem('lastActiveTime', lastActiveTime.toString());

    // Send a POST request to the server to update the streak
    fetch('/updateStreak', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ currentStreak, longestStreak, lastActiveTime })
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
}

function checkStreak() {
    const currentTime = new Date().getTime();
    const elapsedTime = (currentTime - lastActiveTime) / 1000; // Convert to seconds

    if (elapsedTime >= 60) { // Check if 1 minute has passed
        lastActiveTime = currentTime; // Update last active time
        if (streakFlag === 1) {
            currentStreak++; // Increment current streak if streak flag is 1
            updateStreakUI();
            updateStreakInDatabase();
            streakFlag = 0; // Reset streak flag
        } else {
            if (currentStreak > longestStreak) {
                longestStreak = currentStreak; // Update longest streak if current streak is greater
            }
            currentStreak = 0; // Reset current streak
            updateStreakUI();
            updateStreakInDatabase();
        }
    } else if (elapsedTime >= 30 && streakFlag === 0) { // Check if at least 30 seconds have passed and streak flag is 0
        streakFlag = 1; // Set streak flag to 1 if user was active for at least 30 seconds
    }

    if (elapsedTime >= 60 - bufferTime) { // Check if within the buffer time after the end of the minute
        updateStreakUI(); // Update UI at the end of the minute with buffer time
    }
}

function startTimer() {
    intervalId = setInterval(checkStreak, 1000); // Check streak every second
}

function stopTimer() {
    clearInterval(intervalId);
}

document.addEventListener('visibilitychange', () => {
    if (document.visibilityState === 'visible') {
        startTimer();
    } else {
        stopTimer();
        checkStreak();
    }
});

// Initialize UI and start timer
updateStreakUI();
startTimer();
