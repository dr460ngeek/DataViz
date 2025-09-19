<?php
    // include './Backend/session_check.php';

    include './../DB/config.php';

    $currentId = isset($_GET['id']) ? intval($_GET['id']) : 0;

    $sql = "SELECT player_id FROM player_details WHERE status = 1 Limit 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $fetchId = $result['player_id'];

    if($fetchId != $currentId) {
        // header("location: ./Backend/loading.php?uid=".$_SESSION["team_id"]."&id=".$currentId);
         header("location: ./index.php?id=".$fetchId);

    }
       
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       	<meta http-equiv="refresh" content="2">
        <title>IPL Bidding Dashboard</title>
        <link rel="stylesheet" href="style/styles1.css">
    </head>
        <body>
        <div class="container">
            <!-- Header -->
            <div class="dashboard-header">
                <h1 class="dashboard-title">IPL BIDDING DASHBOARD</h1>
                <div class="control-buttons">
                    <button class="control-button" onclick="restart_database()">Restart Database</button>
                </div>
            </div>

            <!-- Left: Leaderboard -->
            <div class="leaderboard">
                <h2 class="section-title">🏆 Leaderboard</h2>
                <div class="leaderboard-content" id="leaderboard-list">
                    <?php include 'Backend/leaderboard.php'; ?>
                </div>
            </div>

            <!-- Center: Current Player Panel -->
            <div class="current-player">
                <div class="player-header">
                    <div class="player-image-container">
                        <?php include 'Backend/player_details.php'; ?>
                    </div>
                    <div class="player-details">
                        <div class="diagonal-bar">
                            <h2 id="player-name">Player Name</h2>
                        </div>
                        <div class="player-info">
                            <span id="player-role">Role: All-Rounder</span>
                            <span id="player-status">Status: Available</span>
                        </div>
                        <div class="current-bidder" id="current-bidder">
                            Current Bidder: Team Name
                        </div>
                    </div>
                </div>
                
                <div class="player-stats">
                    <div class="stat-category">
                        <h3 class="stat-category-title">Batting</h3>
                        <div class="stat-item">
                            <span>4s</span>
                            <span id="player-4">0</span>
                        </div>
                        <div class="stat-item">
                            <span>6s</span>
                            <span id="player-6">0</span>
                        </div>
                        <div class="stat-item">
                            <span>Matches</span>
                            <span id="player-matches">0</span>
                        </div>
                    </div>
                    
                    <div class="stat-category">
                        <h3 class="stat-category-title">Bowling</h3>
                        <div class="stat-item">
                            <span>Wickets</span>
                            <span id="player-wickets">0</span>
                        </div>
                        <div class="stat-item">
                            <span>Economy</span>
                            <span>0.0</span>
                        </div>
                        <div class="stat-item">
                            <span>Best</span>
                            <span>0/0</span>
                        </div>
                    </div>
                    
                    <div class="stat-category">
                        <h3 class="stat-category-title">Fielding</h3>
                        <div class="stat-item">
                            <span>Catches</span>
                            <span id="player-catches">0</span>
                        </div>
                        <div class="stat-item">
                            <span>Run Outs</span>
                            <span id="player-run-outs">0</span>
                        </div>
                        <div class="stat-item">
                            <span>Stumpings</span>
                            <span id="player-stump">0</span>
                        </div>
                    </div>
                </div>
                
                <div class="player-actions">
                    <button class="action-button next-bid-button" onclick="loadNextRecord()">Next Bid</button>
                    <button class="action-button sold-player-button" onclick="markPlayerAsSold()">Sold Player</button>
                    <button class="action-button resume-bid-button" onclick="resumeBid()">Resume Bid</button>
                </div>
            </div>

            <!-- Right: Bidding History -->    
            <div class="bidding-history-container">
                <div class="timer-container">
                    <h2 class="section-title">📜 Bidding History</h2>
                    <div class="time-display" id="timer">90s</div>
                </div>
                
                <div class="bidding-history-content" id="bidding_cycle">
                    <?php include 'Backend/bidding_history.php'; ?>
                </div>
                
                <div class="current-bid" id="current-bid">
                    Current Bid: ₹2.50 Cr
                </div>
            </div>
            
            <!-- Player Box Section -->
            <div class="player-box">
                <div class="sold-players">
                    <div class="box-header">Sold Players</div>
                    <div class="box-list">
                        <!-- Sold players will be listed here -->
                    </div>
                </div>
                
                <div class="upcoming-players">
                    <div class="box-header">Upcoming Players</div>
                    <div class="box-list">
                        <!-- Upcoming players will be listed here -->
                    </div>
                </div>
            </div>
        </div>
        <script src="script/script.js"></script>
    </body>
</html>
