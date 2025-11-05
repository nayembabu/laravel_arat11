<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<div class="container mt-4">
    <form>
        <div class="mb-3">
            <label for="productSelect" class="form-label">মহাজন সিলেক্ট করুন </label>
            <select class="form-select" id="productSelect" name="product">
                <option selected disabled>Choose a product</option>
                <option value="product1">Product 1</option>
                <option value="product2">Product 2</option>
                <option value="product3">Product 3</option>
            </select>
            <button type="submit" class="btn btn-info btn-lg">Submit</button>
        </div>
    </form>
</div>

<?php
    include 'partial/footer.php';
?>