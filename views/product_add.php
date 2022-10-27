<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add Product</title>
  <title>Product List</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="../views/includes/css/styles.css?<?= time() ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../views/includes/js/jquery.js?<?= time() ?>"></script>
</head>

<body>
  <header class="header">
    <div class="title-text">
      <p>Product Add</p>
    </div>
    <ul class="header-btns">
      <li>
        <button type="button" class="btn save-btn" id="SaveAddBtn">Save</button>
      </li>
      <li>
        <a href="../index.php" class="btn cancel-btn">Cancel</a>
      </li>
  </header>

  <hr class="line">

  <div class="wrapper">
    <form id="addForm" class="form">
      <div class="form">
        <div class="input_field">
          <label>SKU</label>
          <input name="product_sku" type="text" class="input" id="sku" />
        </div>
        <div class="input_field">
          <label>Name</label>
          <input name="product_name" type="text" class="input" id="name" />
        </div>
        <div class="input_field">
          <label>Price($)</label>
          <input name="product_price" type="number" class="input" id="price" />
        </div>

        <div class="input_field">
          <label>Type Switcher</label>
          <div class="dropdown"></div>
          <select id="product_type" name="product_type" class="input">
            <option value="Type Switcher">Type Switcher</option>
            <option value="DVD">DVD</option>
            <option value="Furniture">Furniture</option>
            <option value="Book">Book</option>
          </select>
        </div>

        <div>
          <div class="hidden_input_field">
            <div id="DVD">
              <label>Size(mb)</label>
              <input name="product_size" type="number" class="input" id="DVD" min="0" />
              <p> please provide size in Megabytes(MB)</p>
            </div>
          </div>

          <div class="hidden_input_field">
            <div id="Furniture">
              <div>
                <label>Height (CM)</label>
                <input name="product_height" type="number" class="input" id="Height" min="0" />
              </div>

              <div>
                <label>Width (CM)</label>
                <input name="product_width" type="number" class="input" id="width" min="0" />
              </div>

              <div>
                <label>Length (CM)</label>
                <input name="product_length" type="number" class="input" id="Length" min="0" />
              </div>
              <p> please dimensions: height, width, Length in centimeteres(CM)</p>
            </div>
          </div>

          <div class="hidden_input_field">
            <div id="Book">
              <label>weight (KG)</label>
              <input name="product_weight" type="number" class="input" id="Book" min="0" />
              <p> please provide Weight in Kilogrames(KG)</p>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <script>
    $(document).ready(function() {
      $('#product_type').change(function() {
        $(".hidden_input_field").hide();
        $(`#${this.value}`).parent('.hidden_input_field').fadeIn(20);
      });

      $('#SaveAddBtn').click(function() {
        $('#addForm').submit();
      })

      $('#addForm').submit(function(e) {
        e.preventDefault();
        let btn = $('#SaveAddBtn');
        if (btn.is('[disabled]')) return;

        btn.attr('disabled', 'disabled');

        try {
          let data = {};

          $('#addForm .input:not(:hidden)').each(function() {
            let v = this.value;
            if (v.trim() === '') throw new Error('Please, submit required data');
            if (this.type === 'number' && Number(v) <= 0) throw new Error('Please, provide the data of indicated type')

            data[this.name] = v;
          });

          $.post('../CreateController.php', data, function(data, status) {
            $('#SaveAddBtn').removeAttr('disabled');
            try {
              if (data !== 'success' || status !== 'success') {
                console.error(data);
                throw new Error('Failed to add product');
              }

              $('#addForm').trigger('reset');
              new CustomAlert('Product added. Redirecting to Product List...', '#addForm');
              setTimeout(function() {
                location.assign('../index.php')
              }, 1500)
            } catch (error) {
              console.error(error);
              new CustomAlert('Failed to add product', '#addForm', false);
            }
          });
        } catch (error) {
          new CustomAlert(error.message, '#addForm', false);
          btn.removeAttr('disabled', 'disabled');
        }
      });
    });
  </script>
  <?php include_once "{$_SERVER['DOCUMENT_ROOT']}/junior-dev/views/includes/footer.php" ?>
</body>

</html>