Single row


$query = "SELECT ssfullname, ssemail FROM userss WHERE user_id = ".$user_id;
$result = mysqli_query($conn, $query);
$row   = mysqli_fetch_row($result);

$ssfullname = $row['ssfullname'];
$ssemail    = $row['ssemail'];


multiple row




$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}