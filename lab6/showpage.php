<?php
declare(strict_types=1);

function PokazPodstrone(PDO $pdo, string $alias): ?array
{
    $stmt = $pdo->prepare(
        'SELECT id, page_title, page_content
         FROM page_list
         WHERE alias = :alias AND status = 1
         LIMIT 1'
    );
    $stmt->execute([':alias' => $alias]);

    $row = $stmt->fetch();
    return $row === false ? null : $row;
}
