<?php
include '../config/config.php';

$username = $_SESSION['username'];
$title = $_POST['title'] ?? '';
$value = $_POST['value'] ?? '0';
$date = $_POST['date'] ?? '';

//Format income and expeneses
$expenseCategories = [
    'Rent/Mortgage',
    'Utilities',
    'Groceries',
    'Transportation',
    'Healthcare',
    'Entertainment',
    'Miscellaneous'
];

if (in_array($title, $expenseCategories)) {
    $value = -abs($value); // Ensure value is negative for expenses
} else {
    $value = abs($value); // Ensure value is positive for income
}

// Insert new row into finances table
$sql = "INSERT INTO finances (username, title, value, date) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssds", $username, $title, $value, $date);
$stmt->execute();

$newId = $stmt->insert_id;

echo json_encode ([ 
    'success' => true, 
    'row' => [
        'id' => $newId,
        'title' => htmlspecialchars($title),
        'value' => number_format(htmlspecialchars($value), 2, '.',''),
        'date' => htmlspecialchars($date)
    ]
]);

?>
