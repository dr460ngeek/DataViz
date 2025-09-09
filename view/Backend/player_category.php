
<?php
    require_once './../DB/config.php';
    
    $currentUId = isset($_GET['uid']) ? intval($_GET['uid']) : 0;
    
    $sql = "SELECT  player_details.player_specialism, 
                SUM(CASE WHEN player_details.player_status = 'Uncapped' THEN 1 ELSE 0 END) AS uncapped_count,
                COUNT(*) AS total_count
            FROM player_details 
            JOIN winner ON player_details.player_id = winner.player_id
            WHERE winner.team_id = :currentUId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":currentUId", $currentUId, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll();

    $ba_count = 0;
    $un_count = 0;
    $bo_count = 0;
    $ar_count = 0;
    $wk_count = 0;

    foreach ($result as $row) {
         // $u_count += htmlspecialchars($row['uncapped_count']);

         if (htmlspecialchars($row['player_specialism']) == 'BATTER') {
            $ba_count += htmlspecialchars($row['total_count']);
        } else if (htmlspecialchars($row['player_specialism']) == 'BOWLER') {
            $bo_count += htmlspecialchars($row['total_count']);
        } else if (htmlspecialchars($row['player_specialism']) == 'ALL-ROUNDER') {
            $ar_count += htmlspecialchars($row['total_count']);
        } else if (htmlspecialchars($row['player_specialism']) == 'WICKETKEEPER') {
            $wk_count += htmlspecialchars($row['total_count']);
        } else if (htmlspecialchars($row['player_specialism']) == 'Uncapped') {
            $un_count += htmlspecialchars($row['total_count']);
        }else {
            //echo "No player found";
        }
    }
        
?>