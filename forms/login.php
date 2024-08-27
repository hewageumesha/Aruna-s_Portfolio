<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Simple authentication logic (replace with your own)
  if ($username === 'admin' && $password === 'password') {
    $_SESSION['authenticated'] = true;
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
  }
}
?>
