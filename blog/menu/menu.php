<?php 
echo "<div id='menu'>";

echo "<h3 id='mainHeader'>$blog_topics_lg</h3>";
echo "<dl>";
echo "<dt id='menuItem'><a href='".__ROOT_PATH."blog/?cnt=ctg&category=General&pn=1&l=en'>$General_lg</a></dt>";
echo "<dt id='menuItem'><a href='".__ROOT_PATH."blog/?cnt=ctg&category=AndroidOS&pn=1&l=en'>$AndroidOS_lg</a></dt>";
echo "<dt id='menuItem'><a href='".__ROOT_PATH."blog/?cnt=ctg&category=AndroidDevices&pn=1&l=en'>$AndroidDevices_lg</a></dt>";
echo "<dt id='menuItem'><a href='".__ROOT_PATH."blog/?cnt=ctg&category=Developing&pn=1&l=en'>$Developing_lg</a></dt>";
echo "<dt id='menuItem'><a href='".__ROOT_PATH."blog/?cnt=ctg&category=Games&pn=1&l=en'>$Games_lg</a></dt>";
echo "<dt id='menuItem'><a href='".__ROOT_PATH."blog/?cnt=ctg&category=Applications&pn=1&l=en'>$Applications_lg</a></dt>";
echo "</dl>";

echo "</div>";
?>