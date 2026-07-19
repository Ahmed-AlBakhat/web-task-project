<?php
require "db.php";

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $age = filter_input(INPUT_POST, "age", FILTER_VALIDATE_INT);

    if ($name === "" || $age === false || $age < 1 || $age > 120) {
        $message = "Please enter a valid name and age.";
        $messageType = "error";
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO users (name, age, status) VALUES (:name, :age, 0)"
        );
        $stmt->execute([
            ":name" => $name,
            ":age" => $age
        ]);

        $message = "Data added successfully.";
        $messageType = "success";
    }
}

$users = $pdo->query(
    "SELECT id, name, age, status, created_at FROM users ORDER BY id DESC"
)->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Status Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container">
        <section class="card">
            <h1>User Status Manager</h1>
            <p class="subtitle">Add users and change their status between 0 and 1.</p>

            <?php if ($message !== ""): ?>
                <div class="message <?= htmlspecialchars($messageType) ?>">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="user-form">
                <input
                    type="text"
                    name="name"
                    placeholder="Name"
                    maxlength="100"
                    required
                >

                <input
                    type="number"
                    name="age"
                    placeholder="Age"
                    min="1"
                    max="120"
                    required
                >

                <button type="submit">Submit</button>
            </form>
        </section>

        <section class="card table-card">
            <h2>All Records</h2>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Status</th>
                            <th>Toggle</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        <?php if (count($users) === 0): ?>
                            <tr id="emptyRow">
                                <td colspan="5">No records found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $user): ?>
                                <tr data-id="<?= (int)$user["id"] ?>">
                                    <td><?= (int)$user["id"] ?></td>
                                    <td><?= htmlspecialchars($user["name"]) ?></td>
                                    <td><?= (int)$user["age"] ?></td>
                                    <td>
                                        <span
                                            class="status-badge status-<?= (int)$user["status"] ?>"
                                            id="status-<?= (int)$user["id"] ?>"
                                        >
                                            <?= (int)$user["status"] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button
                                            type="button"
                                            class="toggle-btn"
                                            data-id="<?= (int)$user["id"] ?>"
                                        >
                                            Toggle
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>