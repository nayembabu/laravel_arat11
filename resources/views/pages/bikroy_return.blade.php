@include('partials.header')
@include('partials.topmenu')
@include('partials.sidebar')



<div class="container-fluid mt-4">
    <!-- Page Heading and Breadcrumb -->
    <div class="row mb-3">
        <div class="col">
            <h3 class="mb-0">পন্য ফেরত </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-dark px-0 text-white">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Sales</a></li>
                    <li class="breadcrumb-item active"><a href="#">Return</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Filter Form -->
    <form id="commissionFilterForm" class="card mb-4 p-3">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="fromDate" class="form-label">তারিখ হইতে </label>
                <input type="text" class="form-control datepicker" id="fromDate" name="from_date" value="08-09-2025" autocomplete="off">
            </div>
            <div class="col-md-3">
                <label for="toDate" class="form-label">তারিখ পর্যন্ত </label>
                <input type="text" class="form-control datepicker" id="toDate" name="to_date" value="08-09-2025" autocomplete="off">
            </div>
            <div class="col-md-4">
                <label for="customer" class="form-label">গ্রাহক</label>
                <select class="form-select select2" id="customer" name="customer_id" style="width: 100%;" data-placeholder="Select Customer">
                    <option>কাস্টমার ১</option>
                    <option>কাস্টমার ২</option>
                    <option>কাস্টমার ৩</option>
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-search"></i> খুজুন
                </button>
            </div>
        </div>
    </form>

    <!-- Dynamic Button Area -->
    <div id="buttonArea" class="mb-3"></div>
    <!-- Dynamic Card Area -->
    <div id="cardArea" class="mb-3"></div>
    <!-- Dynamic Input Area -->
    <div id="inputArea"></div>
</div>


<script>
$(document).ready(function() {
    $('.select2').select2();

    // Dummy data for buttons
    const buttons = [
        { id: 1, text: '০৫-০৯-২০২৫ --- ১২,০০০.৮৯ টাকা' },
        { id: 2, text: '০৬-০৯-২০২৫ --- ১৫,০০০.০০ টাকা' },
        { id: 3, text: '০৭-০৯-২০২৫ --- ১০,০০০.৫০ টাকা' }
    ];

    // Card data: এখন image + multiple desc lines
    const cards = [
        { 
            id: 1, 
            title: 'Card 1', 
            img: './images/alu.png', 
            desc: [
                'পরিমাণ: ২ বস্তা',
                'লোকেশন: ঢাকা',
                'তারিখ: ২৫ সেপ্টেম্বর'
            ] 
        },
        { 
            id: 2, 
            title: 'Card 2', 
            img: './images/alu.png', 
            desc: [
                'পরিমাণ: ৩ বস্তা',
                'লোকেশন: চট্টগ্রাম',
                'তারিখ: ২৬ সেপ্টেম্বর'
            ] 
        },
        { 
            id: 3, 
            title: 'Card 3', 
            img: './images/alu.png', 
            desc: [
                'পরিমাণ: ১ বস্তা',
                'লোকেশন: কক্সবাজার',
                'তারিখ: ২৭ সেপ্টেম্বর'
            ] 
        }
    ];

    const inputs = [
        { label: 'রিটার্ন পরিমান', name: 'রিটার্ন পরিমান' },
        { label: 'মোট ওজন', name: 'মোট ওজন' },
        { label: 'অন্যান্য খরচ', name: 'অন্যান্য খরচ' }
    ];

    // Generate buttons
    $('#commissionFilterForm').on('submit', function(e) {
        e.preventDefault();
        let btnHtml = '';
        buttons.forEach(btn => {
            btnHtml += `<button type="button" class="btn btn-primary m-1 btn-action" data-id="${btn.id}">${btn.text}</button>`;
        });
        $('#buttonArea').html(btnHtml);
        $('#cardArea').html('');
        $('#inputArea').html('');
    });

    // Generate cards with image + multiple p
    $(document).on('click', '.btn-action', function() {
        let cardHtml = '';
        cards.forEach(card => {
            let descHtml = '';
            card.desc.forEach(line => {
                descHtml += `<p class="card-text mb-1">${line}</p>`;
            });

            cardHtml += `
                <div class="card d-inline-block m-2 card-action" style="width: 14rem; cursor:pointer;" data-id="${card.id}">
                    <img src="${card.img}" class="card-img-top" alt="${card.title}">
                    <div class="card-body">
                        <h5 class="card-title">${card.title}</h5>
                        ${descHtml}
                    </div>
                </div>
            `;
        });
        $('#cardArea').html(cardHtml);
        $('#inputArea').html('');
    });

    // Show inputs when card clicked
    $(document).on('click', '.card-action', function() {
        let inputHtml = '<form class="card p-3" style="max-width:400px;">';
        inputs.forEach(inp => {
            inputHtml += `
                <div class="mb-2">
                    <label class="form-label">${inp.label}</label>
                    <input type="text" class="form-control" name="${inp.name}">
                </div>
            `;
        });
        inputHtml += `<button type="submit" class="btn btn-success mt-2">রিটার্ন করুন</button></form>`;
        $('#inputArea').html(inputHtml);
    });
});
</script>



@include('partials.footer')
