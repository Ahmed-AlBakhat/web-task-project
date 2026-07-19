<?php
header("Content-Type: application/json; charset=utf-8");

require "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode([
        "success" => false,
        "message" => "Method not allowed."
    ]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$id = filter_var($data["id"] ?? null, FILTER_VALIDATE_INT);

if (!$id) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Invalid record ID."
    ]);
    exit;
}

$stmt = $pdo->prepare(
    "UPDATE users
     SET status = CASE WHEN status = 0 THEN 1 ELSE 0 END
     WHERE id = :id"
);
$stmt->execute([":id" => $id]);

if ($stmt->rowCount() === 0) {
    http_response_code(404);
    echo json_encode([
        "success" => false,
        "message" => "Record not found."
    ]);
    exit;
}

$stmt = $pdo->prepare("SELECT status FROM users WHERE id = :id");
$stmt->execute([":id" => $id]);
$user = $stmt->fetch();

echo json_encode([
    "success" => true,
    "status" => (int)$user["status"]
]);
?>