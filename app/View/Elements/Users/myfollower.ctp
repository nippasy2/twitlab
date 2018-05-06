<div id="status_box">
    <div class="user_name"><?php print(h($user['username'])); ?></div>
    <div class="details">
        <div class = "detail">
            <a href="<?php echo '../follow/'.$user['username']; ?>">
                フォローしている
                <div class="count"><?php echo count($follows);?></div>
            </a>
        </div>
        <div class = "detail">
            <a href="<?php echo '../follower/'.$user['username']; ?>">
                フォローされている
                <div class="count"><?php echo count($followers);?></div>
            </a>
        </div>
        <div class = "detail">
            <a href="<?php echo '../tweet/'.$user['username']; ?>">
                投稿数
                <div class="count">
                    <?php echo count($mydatas);?>
                </div>
            </a>
        </div>
    </div>

</div>
