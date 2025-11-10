
@include('partials.header')
@include('partials.topmenu')
@include('partials.sidebar')



<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <label for="mahajanSelect" class="form-label">মহাজন সিলেক্ট করুন</label>
            <select class="form-select" id="mahajanSelect" name="mahajan">
                <option value="">-- সিলেক্ট করুন --</option>
                <option value="mahajan1">মহাজন ১</option>
                <option value="mahajan2">মহাজন ২</option>
                <option value="mahajan3">মহাজন ৩</option>
            </select>
        </div>
    </div>

    <!-- Buttons area (hidden until mahajan selected) -->
    <div id="mahajanButtonsWrap" class="mahajan-buttons mt-3 p-3 rounded" style="display:none;">
        <!-- container background is same; buttons inside have different colors -->
        <div id="mahajanButtons" class="row">
            <!-- buttons inserted here -->
        </div>
    </div>

    <!-- Cards area where small product cards will be appended -->
    <div id="cardsArea" class="mt-3"></div>

    <!-- Dynamic two-column inputs (hidden until a button is clicked) -->
    <form id="dynamicForm" class="mt-3" style="display:none;">
        <div class="row">
            <div class="col-md-6" id="leftCol">
                <h5>বিক্রয় তথ্য</h5>
                <div id="salesFields">
                    <div class="mb-2 row sales-row">
                        <div class="col-6">
                            <input type="text" class="form-control" name="total_bosta[]" placeholder="মোট বস্তা">
                        </div>
                        <div class="col-6">
                            <input type="number" step="any" class="form-control" name="weight[]" placeholder=" ওজন: ">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" name="amount[]" placeholder="দাম">
                        </div>
                        <div class="col-6">
                            <input type="number" step="any" class="form-control" name="total_amount[]" placeholder="মোট দাম: ">
                        </div>
                        </div>
                    </div>
                </div>
                <button type="button" id="addSalesInfo" class="btn btn-sm btn-outline-primary">আরও তথ্য যোগ</button>
            </div>
            <div class="col-md-6 mt-4" id="rightCol">
                <h5>খরচের তথ্য</h5>
                <div id="expenseFields">
                    <div class="mb-2">
                        <input type="text" class="form-control mb-2" name="expense_type[]" placeholder="খরচের ধরণ">
                        <input type="number" step="any" class="form-control" name="expense_amount[]" placeholder="টাকার পরিমান">
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 text-end">
                <button type="button" id="saveBtn" class="btn btn-success">সেভ করুন</button>
            </div>
        </div>
    </form>

</div>

<style>
    /* container background same color */
    .mahajan-buttons{ background: #f1f5f9; }
    .btn-long{ width:100%; text-align:left; margin-bottom:0.5rem; }
    .product-card{ margin-bottom:1rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const mahajanSelect = document.getElementById('mahajanSelect');
    const mahajanButtonsWrap = document.getElementById('mahajanButtonsWrap');
    const mahajanButtons = document.getElementById('mahajanButtons');
    const cardsArea = document.getElementById('cardsArea');
    const dynamicForm = document.getElementById('dynamicForm');
    const addSalesInfo = document.getElementById('addSalesInfo');
    const saveBtn = document.getElementById('saveBtn');

    // sample buttons data (can be replaced by server data)
    const buttonsData = [
        { id: 'p1', label: 'পণ্য A', color: 'btn-primary', desc: 'পণ্যের বর্ণনা A' }
    ];

    mahajanSelect.addEventListener('change', function(){
        const val = this.value;
        if(!val){ mahajanButtonsWrap.style.display = 'none'; mahajanButtons.innerHTML = ''; return; }
        // show buttons area and populate buttons
        mahajanButtonsWrap.style.display = 'block';
        mahajanButtons.innerHTML = '';
        buttonsData.forEach(function(b){
            const col = document.createElement('div');
            col.className = 'col-12';
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = `btn btn-long ${b.color}`;
            btn.textContent = b.label;
            btn.dataset.id = b.id;
            btn.dataset.label = b.label;
            btn.dataset.desc = b.desc;
            btn.addEventListener('click', function(){
                showProductCard(b);
                showForm();
            });
            col.appendChild(btn);
            mahajanButtons.appendChild(col);
        });
    });

    function showProductCard(b){
        // small card with image and details
        const card = document.createElement('div');
        card.className = 'card product-card';
        const body = document.createElement('div');
        body.className = 'card-body d-flex';

        // simple inline svg as placeholder image
        const imgWrap = document.createElement('div');
        imgWrap.style.width = '96px';
        imgWrap.style.height = '96px';
        imgWrap.style.marginRight = '1rem';
        imgWrap.innerHTML = `<img src="./images/alu.png" alt="Place image" width="96" height="96" style="border-radius: 4px; background: #dee2e6;" />`;

        const info = document.createElement('div');
        info.innerHTML = `<h6 class="card-title mb-1">${b.label}</h6><p class="mb-0 text-muted">${b.desc}</p>`;

        body.appendChild(imgWrap);
        body.appendChild(info);
        card.appendChild(body);
        cardsArea.prepend(card);
    }

    function showForm(){
        dynamicForm.style.display = 'block';
    }

    addSalesInfo.addEventListener('click', function(){
        const wrapper = document.getElementById('salesFields');
        const div = document.createElement('div');
        div.className = 'mb-2 row sales-row';
        div.innerHTML = `
                    <div id="salesFields">
                        <div class="mb-2 row sales-row">
                        <div class="col-6">
                            <input type="text" class="form-control" name="total_bosta[]" placeholder="মোট বস্তা">
                        </div>
                        <div class="col-6">
                            <input type="number" step="any" class="form-control" name="Weight[]" placeholder=" ওজন: ">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" name="amount[]" placeholder="দাম">
                        </div>
                        <div class="col-6">
                            <input type="number" step="any" class="form-control" name="total_amount[]" placeholder="মোট দাম: ">
                        </div>
                        </div>
                    </div>`;
        wrapper.appendChild(div);
    });

    saveBtn.addEventListener('click', function(){
        // collect data and show in console (demo)
        const data = {};
        // product cards (first one)
        const firstCard = cardsArea.querySelector('.card');
        data.product = firstCard ? firstCard.querySelector('.card-title').textContent : null;

        // collect sales fields
        data.sales = [];
        document.querySelectorAll('#salesFields .sales-row').forEach(function(row){
            const invoice = row.querySelector('input[name="invoice_no[]"]').value;
            const qty = row.querySelector('input[name="quantity[]"]').value;
            data.sales.push({ invoice: invoice, quantity: qty });
        });

        // collect expense fields
        data.expenses = [];
        document.querySelectorAll('#expenseFields').forEach(function(){
            // single block in this demo
        });
        // read expense inputs
        const expenseTypes = document.querySelectorAll('input[name="expense_type[]"]');
        const expenseAmounts = document.querySelectorAll('input[name="expense_amount[]"]');
        for(let i=0;i<expenseTypes.length;i++){
            data.expenses.push({ type: expenseTypes[i].value, amount: expenseAmounts[i] ? expenseAmounts[i].value : '' });
        }

        console.log('Saved data:', data);
        alert('ডাটা সেভ করা হল (কনসোলে দেখুন)');
    });

});
</script>



@include('partials.footer')