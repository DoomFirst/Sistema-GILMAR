<?php
// Verifica se o formulário de cadastro foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Dados do formulário
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validar e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "O e-mail inserido não é válido.";
        // Pode adicionar mais lógica aqui, como redirecionar de volta ao formulário de cadastro
    } else {
        // Abre o arquivo CSV
        $file = fopen("data.csv", "a");

        // Escreve os dados no arquivo CSV
        fputcsv($file, array($username, $email, $password));

        // Fecha o arquivo CSV
        fclose($file);
    }
}

// Verifica se o formulário de exclusão foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    // Índice do item a ser excluído
    $index = $_POST["index"];

    // Abre o arquivo CSV
    $lines = file("data.csv");

    // Remove a linha do arquivo CSV
    unset($lines[$index]);

    // escreve o arqiivo em volta
    file_put_contents("data.csv", implode("", $lines));
}
?>

