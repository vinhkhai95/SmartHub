<?php
if (!empty($alert_message)):
?>
<script>
    autoAlert('<?= $alert_message ?>');
</script>
<?php
endif;
?>