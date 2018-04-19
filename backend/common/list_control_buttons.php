<a data-toggle="tooltip" data-placement="left" title="" 
   data-original-title="View Detail" href="index.php?action=<?= $type ?>_detail&<?= $type ?>_id=<?= $row[$type . '_id'] ?>">
    <i class="fa fa-eye"></i>
</a>
<a data-toggle="tooltip" data-placement="left" title="" 
   data-original-title="Edit"  
   href="index.php?action=<?= $type ?>_edit&<?= $type ?>_id=<?= $row[$type . '_id'] ?>">
    <i class="fa fa-edit"></i>
</a>
<a href="#" data-toggle="tooltip" data-placement="left" title="" 
   data-original-title="Delete" 
   onclick="confirmDelete('index.php?action=<?= $type ?>_delete&<?= $type ?>_id=<?= $row[$type . '_id'] ?>', '<?= $type ?>')">
    <i class="fa fa-trash-o"></i>
</a>