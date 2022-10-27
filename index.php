<!DOCTYPE html>
<html lang="en">

<head>
  <title>Product List</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="./views/includes/css/styles.css?<?= time() ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="./views/includes/js/jquery.js?<?= time() ?>"></script>
  <style>
    #productContainer .form-alert {
      margin: 0 auto;
      width: fit-content;
    }
  </style>
</head>

<body>
  <header class="header">
    <div class="title-text">
      <p>Product list</p>
    </div>

    <hr class="top-line">

    <ul class="header-btns">
      <li>
        <a href="./views/product_add.php" class="btn add-btn">ADD</a>
      </li>
      <li><button id="delete-product-btn" class="btn delete-product-btn">MASS DELETE</button></li>
    </ul>
  </header>

  <div class="container" id="productContainer">
    <div id="product-list">
      <?php
      require_once './Models/display.php';
      $display = new DisplayProduct();
      $display->displayProduct();
      ?>
    </div>
  </div>

  <script>
    $('#delete-product-btn').click(function() {
      if (this.disabled) return;
      try {
        var ids = [],
          str = [];

        this.disabled = true;

        $('#product-list .delete-checkbox:checked').each(function() {
          ids.push(this.value);
          str.push(`[data-product-id="${this.value}"]`)

        });

        str = str.join(',');

        if (!ids.length) new CustomAlert('Please select at least one product', '#productContainer');

        $.post('./DeleteController.php', {
          'delete-id': ids,
          'delete-str': str
        }, function(data, status) {
          $('#delete-product-btn').removeAttr('disabled');
          try {
            let ad = getAjaxData(this);

            if (data !== 'success' || status !== 'success') {
              throw new Error(data);
            }

            $(`${ad['delete-str']}`).remove();

            new CustomAlert('Product(s) deleted', '#productContainer');

          } catch (error) {
            console.error(error);
            new CustomAlert('Failed to delete product(s)', '#productContainer', false);
          }
        })
      } catch (error) {
        console.error(error);
        new CustomAlert('Failed to delete product(s)', '#productContainer', false);
        $('#delete-product-btn').removeAttr('disabled');
      }
    });
  </script>
  <footer class="footer">
    <hr class="bottom-line">
    <p> Scandiweb Test assignment</p>
  </footer>
</body>

</html>