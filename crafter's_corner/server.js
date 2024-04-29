const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');

const app = express();
const PORT = 3000;

// MySQL database connection configuration
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'streak_user',
    password: 'password',
    database: 'streakDB'
});

// Connect to MySQL database
connection.connect((err) => {
    if (err) {
        console.error('Error connecting to MySQL database:', err);
        return;
    }
    console.log('Connected to MySQL database');
});

app.use(bodyParser.json());

// Create a table for streak data if not exists
const createTableQuery = `
    CREATE TABLE IF NOT EXISTS streak (
        id INT AUTO_INCREMENT PRIMARY KEY,
        currentStreak INT DEFAULT 0,
        longestStreak INT DEFAULT 0,
        lastActiveTime BIGINT DEFAULT 0
    )
`;
connection.query(createTableQuery, (err) => {
    if (err) {
        console.error('Error creating streak table:', err);
        return;
    }
    console.log('Streak table created or already exists');
});

// Update streak endpoint
app.post('/updateStreak', (req, res) => {
    const { currentStreak, longestStreak, lastActiveTime } = req.body;
    const updateQuery = `UPDATE streak SET currentStreak = ${currentStreak}, longestStreak = ${longestStreak}, lastActiveTime = ${lastActiveTime} WHERE id = 1`;
    connection.query(updateQuery, (err, result) => {
        if (err) {
            console.error('Error updating streak in MySQL:', err);
            res.status(500).json({ error: 'Error updating streak' });
            return;
        }
        console.log('Streak updated in MySQL');
        res.json({ message: 'Streak updated in MySQL' });
    });
});

// Serve static files (HTML, CSS, JS)
app.use(express.static('public'));

// Start the server
app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});
