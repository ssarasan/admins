<?php
$pdo = new PDO("mysql:host=localhost;dbname=cms", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$action = $_GET['action'] ?? 'read';

switch ($action) {
    case 'create':
        $title = $_POST['title'];
        $start = $_POST['start_date'];
        $end   = $_POST['end_date'] ?: null;

        $stmt = $pdo->prepare("INSERT INTO events (title, start_date, end_date) VALUES (?, ?, ?)");
        $stmt->execute([$title, $start, $end]);

        echo json_encode(['status' => 'success']);
        break;

    case 'update':
        $id    = $_POST['id'];
        $title = $_POST['title'];
        $start = $_POST['start_date'];
        $end   = $_POST['end_date'] ?: null;

        $stmt = $pdo->prepare("UPDATE events SET title=?, start_date=?, end_date=? WHERE id=?");
        $stmt->execute([$title, $start, $end, $id]);

        echo json_encode(['status' => 'success']);
        break;

    case 'delete':
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM events WHERE id=?");
        $stmt->execute([$id]);

        echo json_encode(['status' => 'success']);
        break;

    case 'read':
    default:
        $stmt = $pdo->query("SELECT id, title, start_date AS start, end_date AS end FROM events");
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($events);
}
