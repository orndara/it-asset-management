<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ប្រព័ន្ធគ្រប់គ្រងសម្ភារៈ IT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>
                <i class="fas fa-laptop-code"></i>
                ប្រព័ន្ធគ្រប់គ្រងសម្ភារៈ IT
            </h1>
            <p><i class="fas fa-database"></i> គ្រប់គ្រងឧបករណ៍បច្ចេកវិទ្យាព័ត៌មានវិទ្យា</p>
        </div>
        
        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-boxes"></i>
                <div class="number" id="totalCount">0</div>
                <div class="label">សរុបទាំងអស់</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-check-circle"></i>
                <div class="number" id="activeCount">0</div>
                <div class="label">កំពុងប្រើប្រាស់</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-tools"></i>
                <div class="number" id="repairCount">0</div>
                <div class="label">កំពុងជួសជុល</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-archive"></i>
                <div class="number" id="stockCount">0</div>
                <div class="label">ស្តុកទុក</div>
            </div>
        </div>
        
        <!-- Form -->
        <div class="form-section">
            <div class="form-title" id="formTitle">
                <i class="fas fa-plus-circle"></i> បន្ថែមសម្ភារៈថ្មី
            </div>
            <form id="equipmentForm">
                <input type="hidden" id="equipmentId" name="id">
                <div class="form-grid">
                    <div class="input-group">
                        <label><i class="fas fa-tag"></i> ឈ្មោះសម្ភារៈ *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-barcode"></i> លេខសៀរៀល</label>
                        <input type="text" id="serial_number" name="serial_number">
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-folder"></i> ប្រភេទ</label>
                        <select id="category" name="category">
                            <option value="កុំព្យូទ័រ">កុំព្យូទ័រ</option>
                            <option value="ម៉ូនីទ័រ">ម៉ូនីទ័រ</option>
                            <option value="បណ្តាញ">បណ្តាញ</option>
                            <option value="គ្រឿងបន្ថែម">គ្រឿងបន្ថែម</option>
                            <option value="សូហ្វវែរ">សូហ្វវែរ</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-chart-line"></i> ស្ថានភាព</label>
                        <select id="status" name="status">
                            <option value="កំពុងប្រើប្រាស់">កំពុងប្រើប្រាស់</option>
                            <option value="ស្តុកទុក">ស្តុកទុក</option>
                            <option value="កំពុងជួសជុល">កំពុងជួសជុល</option>
                            <option value="បិទប្រើប្រាស់">បិទប្រើប្រាស់</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-user"></i> អ្នកទទួលខុសត្រូវ</label>
                        <input type="text" id="assigned_to" name="assigned_to">
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-calendar"></i> កាលបរិច្ឆេទទិញ</label>
                        <input type="date" id="purchase_date" name="purchase_date">
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-dollar-sign"></i> តម្លៃ (USD)</label>
                        <input type="number" id="price" name="price" step="0.01">
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-sticky-note"></i> កំណត់ចំណាំ</label>
                        <textarea id="notes" name="notes" rows="3"></textarea>
                    </div>
                </div>
                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save"></i> រក្សាទុក
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">
                        <i class="fas fa-undo"></i> កំណត់ឡើងវិញ
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Toolbar -->
        <div class="toolbar">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="🔍 ស្វែងរកសម្ភារៈ...">
                <button class="btn btn-secondary" id="clearSearch">
                    <i class="fas fa-eraser"></i> សម្អាត
                </button>
            </div>
            <div class="filter-group">
                <select id="filterCategory">
                    <option value="">ទាំងអស់</option>
                    <option value="កុំព្យូទ័រ">កុំព្យូទ័រ</option>
                    <option value="ម៉ូនីទ័រ">ម៉ូនីទ័រ</option>
                    <option value="បណ្តាញ">បណ្តាញ</option>
                    <option value="គ្រឿងបន្ថែម">គ្រឿងបន្ថែម</option>
                </select>
                <select id="filterStatus">
                    <option value="">ទាំងអស់</option>
                    <option value="កំពុងប្រើប្រាស់">កំពុងប្រើប្រាស់</option>
                    <option value="ស្តុកទុក">ស្តុកទុក</option>
                    <option value="កំពុងជួសជុល">កំពុងជួសជុល</option>
                </select>
            </div>
        </div>
        
        <!-- Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ល.រ</th><th>ឈ្មោះសម្ភារៈ</th><th>លេខសៀរៀល</th>
                        <th>ប្រភេទ</th><th>ស្ថានភាព</th><th>អ្នកទទួលខុសត្រូវ</th>
                        <th>តម្លៃ</th><th>សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody id="equipmentTableBody">
                    <tr><td colspan="8" class="loading">កំពុងផ្ទុក...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="script.js"></script>
</body>
</html>