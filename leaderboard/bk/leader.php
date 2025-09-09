<?php
include './../DB/config.php';

$stmt = $conn->prepare("SELECT t1.team_id, t1.team_name, t1.team_logo,
                                SUM(t3.player_points) as total_points
                        FROM team as t1
                        JOIN winner as t2 ON t1.team_id = t2.team_id
                        JOIN player_details as t3 ON t2.player_id = t3.player_id
                        GROUP BY t1.team_id
                        ORDER BY total_points DESC
");
$stmt->execute();

$result = $stmt->fetchAll();
if (is_array($result)) {
    $rank = 1;
    foreach ($result as $row) {
        $topClass = '';
        $badgeIcon = '';
        
        if ($rank === 1) {
            $topClass = 'gold-team';
            $badgeIcon = '<span class="badge gold"> 1st</span>';
        } else if ($rank === 2) {
            $topClass = 'silver-team';
            $badgeIcon = '<span class="badge silver"> 2nd</span>';
        } 

        echo "<div class='team-card $topClass'>
                $badgeIcon
                <img src='./../images/logo/".$row['team_logo']."' alt='".$row['team_name']."' class='team-image'>
                <span class='team-name'>".$row['team_name']."</span>
                <span class='score'>".$row['total_points']." pts</span>
            </div>";
        $rank++;
    }
} else {
    echo "<div class='team-rank'> No teams found. </div>";
}
?>