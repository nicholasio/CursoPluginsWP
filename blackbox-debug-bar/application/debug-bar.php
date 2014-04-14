<?php

global $wpdb; 
$bb = BlackBox::getInstance(); 
$time = number_format($bb->getProfiler()->totalTime()*1000, 2); 
$sqlC = count($wpdb->queries);
$sqlT = 0;
foreach($wpdb->queries as $q) {
    $sqlT += $q[1];
}
$err = count($bb->getErrors());
$errI = 0;
foreach($bb->getErrors() as $error) {
    if($error['errno'] == E_WARNING) {
        $errI++;
    }
}

?>

<div id="blackbox-web-debug">
&nbsp;
<a href="javascript:WpDebugBar.switchPanel('globals')" class="globals">Globals</a>
<a href="javascript:WpDebugBar.switchPanel('profiler')" class="profiler">Profiler (<?php echo $time ?> ms)</a>
<a href="javascript:WpDebugBar.switchPanel('database')" class="database">SQL (<span class="qnum"><?php echo $sqlC ?></span> queries in <span class="qtime"><?php echo number_format($sqlT*1000, 2) ?></span> ms)</a>
<a href="javascript:WpDebugBar.switchPanel('errors')" class="errors">Errors (<?php echo $err; if($errI>0) echo ", $errI!" ?>)</a>
<a href="#" class="toggle off">Toggle</a>
<a href="javascript:WpDebugBar.close()" class="close">Close</a>

<div id="blackbox-globals" class="debug-panel">
<pre><code class="php">$_GET = <?php echo esc_html(var_export($bb->getGlobal("get"), true)) ?>;</code></pre><br/>
<pre><code class="php">$_POST = <?php echo esc_html(var_export($bb->getGlobal("post"), true)) ?>;</code></pre><br />
<pre><code class="php">$_COOKIE = <?php echo esc_html(var_export($bb->getGlobal("cookie"), true)) ?>;</code></pre><br />
<pre><code class="php">$_SESSION = <?php echo esc_html(var_export($bb->getGlobal("session"), true)) ?>;</code></pre><br />
<pre><code class="php">$_SERVER = <?php echo esc_html(var_export($bb->getGlobal("server"), true)) ?>;</code></pre><br />
</div>

<div id="blackbox-profiler" class="debug-panel">
<table>
    <tbody>
    <?php $x = $bb->getProfiler()->getInit() ?>
    <?php foreach($bb->getProfiler()->getMeasure() as $time): ?>
        <tr>
            <td><?php echo ($time['name']); ?></td>
            <td class="number"><?php echo number_format(round(($time['time']-$x)*1000, 4), 4); ?> ms</td>
            <td><?php echo round($time['memory']/1000) ?> kB</td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>

<div id="blackbox-database" class="debug-panel">
<form action="" method="get" class="blackbox-filter">
	<label for="bb_query_filter">Find queries containing</label>
	<input type="text" name="bb_query_filter" id="bb_query_filter" value="" />
	
	<label for="bb_query_min_time">Min. Execution Time</label>
	<input type="text" name="bb_query_min_time" id="bb_query_min_time" value="" />
</form>
<table>
    <tbody>
        <?php foreach($wpdb->queries as $q): ?>
        <tr>
            <td class="number">
                <?php echo number_format(round($q[1]*1000, 4), 4); ?> [ms]
            </td>
            <td>
                <pre><code class="sql"><?php echo wordwrap($q[0], 150).";\r\n"; ?></code></pre>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<div id="blackbox-errors" class="debug-panel">
    <table>
        <tbody>
            <?php foreach($bb->getErrors() as $error): ?>
            <tr>
                <td class="err-name">
                    <span <?php if($error['errno'] == E_WARNING): ?>style="color:red"<?php endif; ?>><?php echo $error['name'] ?></span>
                    <?php if($error['count']>1): ?> (<?php echo $error['count'] ?>)<?php endif; ?></td>
                <td><?php echo $error['message'] ?> on line <?php echo $error['line']; ?> in file <?php echo $error['file'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</div>


</div>
