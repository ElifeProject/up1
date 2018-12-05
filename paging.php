<?php
echo "<ul class='pagination'>";
 
// button for first page
if($page>1){
    echo "<li><a href='{$page_url}' title='Go to the first page.'>";
        echo "First";
    echo "</a></li>";
}
 
// calculate total pages
$t_pages = ceil($t_rows / $records_per_page);
 
// Range of links to show
$Range = 2;
 
// display links to 'Range of pages' around 'current page'
$init_num = $page - $Range;
$cond_limit_num = ($page + $Range)  + 1;
 
for ($x=$init_num; $x<$cond_limit_num; $x++) {
 
    // be sure '$x is greater than 0' AND 'less than or equal to the $t_pages'
    if (($x > 0) && ($x <= $t_pages)) {
 
        // current page
        if ($x == $page) {
            echo "<li class='active'><a href=\"#\">$x <span class=\"sr-only\">(current)</span></a></li>";
        } 
 
        // not current page
        else {
            echo "<li><a href='{$page_url}page=$x'>$x</a></li>";
        }
    }
}
 
// button for last page
if($page<$t_pages){
    echo "<li><a href='" .$page_url. "page={$t_pages}' title='Last page is {$t_pages}.'>";
        echo "Last";
    echo "</a></li>";
}
 
echo "</ul>";
?>