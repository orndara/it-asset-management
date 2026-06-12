// Load equipment on page load
$(document).ready(function() {
    loadEquipment();
    loadStats();
    
    // Submit form
    $('#equipmentForm').on('submit', function(e) {
        e.preventDefault();
        saveEquipment();
    });
    
    // Search and filter
    $('#searchInput').on('keyup', function() {
        loadEquipment();
    });
    
    $('#filterCategory, #filterStatus').on('change', function() {
        loadEquipment();
    });
    
    $('#clearSearch').on('click', function() {
        $('#searchInput').val('');
        loadEquipment();
    });
});

function loadEquipment() {
    const search = $('#searchInput').val();
    const category = $('#filterCategory').val();
    const status = $('#filterStatus').val();
    
    $.ajax({
        url: 'get_equipment.php',
        type: 'GET',
        data: { search: search, category: category, status: status },
        success: function(response) {
            $('#equipmentTableBody').html(response);
        }
    });
}

function loadStats() {
    $.ajax({
        url: 'get_stats.php',
        type: 'GET',
        success: function(response) {
            const stats = JSON.parse(response);
            $('#totalCount').text(stats.total);
            $('#activeCount').text(stats.active);
            $('#repairCount').text(stats.repair);
            $('#stockCount').text(stats.stock);
        }
    });
}

function saveEquipment() {
    const formData = $('#equipmentForm').serialize();
    const id = $('#equipmentId').val();
    const url = id ? 'edit_equipment.php' : 'add_equipment.php';
    
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        success: function(response) {
            if(response === 'success') {
                resetForm();
                loadEquipment();
                loadStats();
                alert(id ? 'កែប្រែដោយជោគជ័យ' : 'បន្ថែមដោយជោគជ័យ');
            } else {
                alert('មានបញ្ហា: ' + response);
            }
        }
    });
}

function editEquipment(id) {
    $.ajax({
        url: 'get_equipment.php',
        type: 'GET',
        data: { id: id },
        success: function(response) {
            const data = JSON.parse(response);
            $('#equipmentId').val(data.id);
            $('#name').val(data.name);
            $('#serial_number').val(data.serial_number);
            $('#category').val(data.category);
            $('#status').val(data.status);
            $('#assigned_to').val(data.assigned_to);
            $('#purchase_date').val(data.purchase_date);
            $('#price').val(data.price);
            $('#notes').val(data.notes);
            $('#formTitle').html('<i class="fas fa-edit"></i> កែប្រែសម្ភារៈ');
            $('#submitBtn').html('<i class="fas fa-save"></i> កែប្រែ');
            $('html, body').animate({ scrollTop: 0 }, 'slow');
        }
    });
}

function deleteEquipment(id) {
    if(confirm('តើអ្នកពិតជាចង់លុបសម្ភារៈនេះមែនទេ?')) {
        $.ajax({
            url: 'delete_equipment.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                if(response === 'success') {
                    loadEquipment();
                    loadStats();
                    alert('លុបដោយជោគជ័យ');
                } else {
                    alert('មានបញ្ហា: ' + response);
                }
            }
        });
    }
}

function resetForm() {
    $('#equipmentForm')[0].reset();
    $('#equipmentId').val('');
    $('#formTitle').html('<i class="fas fa-plus-circle"></i> បន្ថែមសម្ភារៈថ្មី');
    $('#submitBtn').html('<i class="fas fa-save"></i> រក្សាទុក');
}