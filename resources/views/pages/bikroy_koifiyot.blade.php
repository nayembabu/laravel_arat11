@include('partials.header')
@include('partials.topmenu')
@include('partials.sidebar')


<style>
.btn-gradient {
    background: linear-gradient(90deg, #ff6ec4, #7873f5);
    transition: all 0.3s ease;
}
.btn-gradient:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.2);
}
.text-gradient {
    font-size: 1.8rem;
}
@media(max-width:768px){
    .btn-gradient {
        width: 100%;
    }
}
/* Select2 dropdown height fix */ 
.select2-container .select2-selection--single {
    height: calc(2.5rem + 2px); /* Bootstrap form-select height */
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
}

/* Vertically center the text */
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: calc(2.5rem);
}

/* Dropdown arrow alignment fix */
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: calc(2.5rem);
}

</style>



<div class="container mt-4">
    <h2 class="mb-4 text-gradient fw-bold" style="background: linear-gradient(90deg, #ff6ec4, #7873f5); -webkit-background-clip: text; color: transparent;">
        বিক্রয় কৈফিয়ত
    </h2>
    
    <form id="searchForm" class="row g-3 align-items-end p-3 shadow rounded-3" style="background: linear-gradient(135deg, #f6f9ff, #e0f7fa);">
        <div class="col-md-3 col-12">
            <label for="from_date" class="form-label fw-semibold">From Date</label>
            <input type="text" class="form-control" id="from_date" placeholder="Select From Date">
        </div>
        <div class="col-md-3 col-12">
            <label for="to_date" class="form-label fw-semibold">To Date</label>
            <input type="text" class="form-control" id="to_date" placeholder="Select To Date">
        </div>
        <div class="col-md-4 col-12">
            <label for="customer" class="form-label fw-semibold">Customer</label>
            <select id="customer" class="form-select select2">
                <option value="">কাস্টমার সিলেক্ট করুন</option>
                <option value="1">মোঃ করিম</option>
                <option value="2">আব্দুল রহিম</option>
                <option value="3">নূর আলম</option>
                <option value="4">সালমা বেগম</option>
                <option value="5">রফিক মিয়া</option>
                <option value="6">জামাল উদ্দিন</option>
                <option value="7">ফারজানা আক্তার</option>
                <option value="8">মোস্তাফিজুর রহমান</option>
                <option value="9">সাবরিনা সুলতানা</option>
                <option value="10">আনিসুর রহমান</option>
            </select>
        </div>
        <div class="col-md-2 col-12 d-grid">
            <button type="submit" class="btn btn-gradient text-white fw-bold">Search</button>
        </div>
    </form>

    <!-- Result Table -->
    <div class="mt-4">
        <table id="resultTable" class="table table-striped table-bordered" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>Customer Name</th>
                    <th>Purchase Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated after search -->
            </tbody>
        </table>
    </div>
</div>

<script>
$(function() {
    /*** UI INIT ***/
    $("#from_date, #to_date").datepicker({
        dateFormat: 'dd-mm-yy',
        showAnim: 'slideDown'
    });

   

    let table = $('#resultTable').DataTable({
        responsive: true,
        searching: false,
        paging: true,
        info: false
    });

    /*** DEMO STATIC DATA ***/
    const staticData = {
        1: [{ name: "মোঃ করিম",          date: "07-11-2025", amount: "15,000", status: "paid"   }],
        2: [{ name: "আব্দুল রহিম",        date: "06-11-2025", amount: "22,500", status: "unpaid" }],
        3: [{ name: "নূর আলম",            date: "05-11-2025", amount: "18,750", status: "paid"   }],
        4: [{ name: "সালমা বেগম",         date: "04-11-2025", amount: "30,000", status: "unpaid" }],
        5: [{ name: "রফিক মিয়া",          date: "03-11-2025", amount: "25,000", status: "paid"   }],
        6: [{ name: "জামাল উদ্দিন",        date: "02-11-2025", amount: "12,000", status: "paid"   }],
        7: [{ name: "ফারজানা আক্তার",     date: "01-11-2025", amount: "28,000", status: "unpaid" }],
        8: [{ name: "মোস্তাফিজুর রহমান",   date: "31-10-2025", amount: "35,000", status: "paid"   }],
        9: [{ name: "সাবরিনা সুলতানা",    date: "30-10-2025", amount: "20,000", status: "unpaid" }],
        10:[{ name: "আনিসুর রহমান",        date: "29-10-2025", amount: "40,000", status: "paid"   }]
    };

    /*** HELPERS ***/
    function parseDDMMYYYY(str) {
        // Expecting 'dd-mm-yyyy'
        const parts = str.split('-');
        if (parts.length !== 3) return null;
        const [dd, mm, yyyy] = parts.map(p => parseInt(p, 10));
        if (isNaN(dd) || isNaN(mm) || isNaN(yyyy)) return null;
        // JS months are 0-based
        return new Date(yyyy, mm - 1, dd);
    }

    function isBetweenInclusive(target, start, end) {
        return target >= start && target <= end;
    }

    /*** FORM SUBMIT ***/
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();

        const from = $('#from_date').val().trim();
        const to   = $('#to_date').val().trim();
        const customer = $('#customer').val();

        // Basic required validation
        if (!from || !to || !customer) {
            Swal.fire({
                icon: 'warning',
                title: 'তথ্য অসম্পূর্ণ',
                text: 'অনুগ্রহ করে From, To ও Customer নির্বাচন করুন',
                confirmButtonText: 'ঠিক আছে'
            });
            return;
        }

        // Date parsing & range validation
        const fromDate = parseDDMMYYYY(from);
        const toDate   = parseDDMMYYYY(to);

        if (!fromDate || !toDate) {
            Swal.fire({
                icon: 'error',
                title: 'তারিখ সঠিক নয়',
                text: 'তারিখের ফরম্যাট হওয়া উচিত dd-mm-yyyy',
                confirmButtonText: 'ঠিক আছে'
            });
            return;
        }

        if (fromDate > toDate) {
            Swal.fire({
                icon: 'warning',
                title: 'ভুল তারিখ রেঞ্জ',
                text: 'From Date, To Date-এর আগে হতে হবে',
                confirmButtonText: 'ঠিক আছে'
            });
            return;
        }

        // Loading state
        const btn = $(this).find('button[type="submit"]');
        const originalText = btn.html();
        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> অনুসন্ধান হচ্ছে...');
        btn.prop('disabled', true);

        // Clear table
        table.clear();

        // Filter data by customer + date range
        const rows = (staticData[customer] || []).filter(item => {
            const d = parseDDMMYYYY(item.date);
            return d && isBetweenInclusive(d, fromDate, toDate);
        });

        if (rows.length === 0) {
            // No data found
            table.draw();
            Swal.fire({
                icon: 'info',
                title: 'কোনো ডেটা পাওয়া যায়নি',
                text: 'নির্বাচিত কাস্টমার ও তারিখ রেঞ্জে কোনো রেকর্ড নেই',
                confirmButtonText: 'ঠিক আছে'
            });
        } else {
            rows.forEach(item => {
                table.row.add([
                    item.name,
                    item.date,
                    '৳' + item.amount,
                    item.status === 'paid'
                        ? '<span class="badge bg-success">পরিশোধিত</span>'
                        : '<span class="badge bg-warning text-dark">বাকি</span>'
                ]);
            });
            table.draw();

            Swal.fire({
                icon: 'success',
                title: 'ডেটা লোড হয়েছে',
                timer: 1200,
                showConfirmButton: false
            });
        }

        // Reset button
        btn.html(originalText);
        btn.prop('disabled', false);
    });
});
</script>



@include('partials.footer')
