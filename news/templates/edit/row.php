<tr valign="top">
<td nowrap="nowrap">
<?php

$url = Util::addParameter($edit_url, array('page' => $page, 'id' => $row['id']));
echo Horde::link($url,_("Edit")) .
     Horde::img('edit.png', _("Edit"), '', $img_dir) . '</a>  &nbsp;';

echo Horde::link(Util::addParameter($browse_url, 'id', $row['id']), _("Info")) .
     Horde::img('devel.png', _("Info"), '', $img_dir). '</a>  &nbsp;';

/* admins options */
if (Auth::isAdmin() || isset($allowed_cats[$row['category1']]) || isset($allowed_cats[$row['category2']])) {

    if ($row['status'] == News::CONFIRMED) {
        $url = Util::addParameter($browse_url, array('page' => $page, 'actionID' => 'deactivate', 'id' =>  $row['id']));
        echo Horde::link($url,_("Deactivate")) . Horde::img('cross.png', _("Deactivate"), '', $img_dir) . '</a> ';
    } else {
        $url = Util::addParameter($browse_url, array('page' => $page, 'actionID' => 'activate', 'id' => $row['id']));
        echo Horde::link($url,_("Activate")) . Horde::img('tick.png', _("Activate"), '', $img_dir) . '</a> ';

        $url = Util::addParameter(Horde::applicationUrl('delete.php'), 'id',  $row['id']);
        echo Horde::link($url,_("Delete"), '', '', '', _("Delete")) . Horde::img('delete.png', _("Delete"), '', $img_dir) . '</a>  &nbsp;';

        if ($row['status'] == News::LOCKED) {
            $url = Util::addParameter($browse_url, array('page' => $page, 'actionID' => 'unlock', 'id' => $row['id']));
            echo Horde::link($url,_("Unlock")) . Horde::img('map.png', '', '', $img_dir) . '</a> ';
        } else {
            $url = Util::addParameter($browse_url, array('page' => $page, 'actionID' => 'lock', 'id' => $row['id']));
            echo Horde::link($url,_("Lock")) . Horde::img('locked.png', '', '', $img_dir) . '</a> ';
        }
    }
}

?>
</td>
<td>
<?php

switch ($row['status']) {
case News::UNCONFIRMED:
    echo _("Unconfirmed");
    break;

case News::CONFIRMED:
    echo _("Confirmed");
    break;

case News::LOCKED:
    echo _("Locked");
    break;
}
?></td>
<td><?php echo Horde::link(News::getUrlFor('news', $row['id']), _("Read"), '', '_blank') . $row['title']; ?></a></td>
<td><?php echo $news->dateFormat($row['publish']) ?></td>
<td><?php echo $row['user'] ?></td>
<td>
<?php
$url = Util::addParameter($read_url, 'id', $row['id']);
echo Horde::link('javascript:void(0)', $row['view_count'], '', '', "popup('$url')", $row['view_count']) . number_format($row['view_count']) . '</a>';
?>
</td>
<?php
if ($has_comments) {
    echo '<td>' . $row['comments'] . '</td>';
}
?>
</tr>