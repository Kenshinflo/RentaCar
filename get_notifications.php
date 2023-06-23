<!-- <?php
// Database connection configuration

 $host = 'localhost';
 $user = 'root';
 $password = '';
 $database = "rentacar";

// Create database connection
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch notifications for a specific user
function getNotifications($userId, $conn)
{
    $sql = "SELECT * FROM notification_user WHERE user_id = '$userId' ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $notifications = array();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $notifications[] = $row;
        }
    }
    
    return $notifications;
}

// Example usage

// User registration or login (get the user ID)
$userId = 1;

// Fetch notifications for the user
$notifications = getNotifications($userId, $conn);
if (!empty($notifications)) {
    foreach ($notifications as $notification) {
        $notificationId = $notification['id'];
        $message = $notification['message'];
        $createdAt = $notification['created_at'];
        $isRead = $notification['is_read'] == 1 ? "Read" : "Unread";

        echo "<div>";
        echo "Notification ID: $notificationId<br>";
        echo "Message: $message<br>";
        echo "Created At: $createdAt<br>";
        echo "Status: $isRead<br>";
        echo "<hr>";
        echo "</div>";
    }
} else {
    echo "No notifications found.";
}

$conn->close();
?> -->
