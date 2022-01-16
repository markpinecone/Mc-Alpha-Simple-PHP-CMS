<nav id="navbar">
    <ul>
        <li><a href="/admin/index.php">Dashboard</a></li>
        <li><a href="/index.php">View Site</a></li>
		<div class="right">
			<li><a href="/admin/index.php?action=pages">Pages</a></li>
            <li><a href="/admin/index.php?action=users">Users</a></li>
			<li style="background-color: crimson;"> <a href="/admin/index.php?action=logout">Logout</a></li>
		</div>
    </ul>
</nav>

<?php
if (isset($_GET['error']) || isset($_GET['notify'])) {
        include_once INCLUDE_DIR . '/msghandler.inc.php';
}
?>
