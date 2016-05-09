    </div>
    <div id="footer">Copyright <?php echo date("Y", time()); ?>, Akmal Fayziyev</div>
    <script type="text/javascript" src="../scripts/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../scripts/bootstrap.min.js"></script>
    <script type="text/javascript" src="../scripts/main.js"></script>
  </body>
</html>
<?php if(isset($db)) { $db->close_connection(); } ?>