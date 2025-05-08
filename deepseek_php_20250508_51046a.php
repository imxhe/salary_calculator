<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>牛马计算器 - 打工人的时间提款‪机‬</title>
    <style>
        :root {
            --primary-color: #4a6bdf;
            --secondary-color: #f8f9fa;
            --accent-color: #ff6b6b;
            --text-color: #333;
            --light-text: #6c757d;
            --border-color: #dee2e6;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', 'PingFang SC', 'Microsoft YaHei', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: #f5f7ff;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .calculator {
            width: 100%;
            max-width: 500px;
            background-color: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: var(--shadow);
            margin: 20px 0;
            transition: all 0.3s ease;
        }
        
        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 25px;
            font-size: 1.8rem;
        }
        
        h2 {
            color: var(--primary-color);
            font-size: 1.4rem;
            margin-bottom: 15px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 8px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 16px;
            transition: border 0.3s;
        }
        
        input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(74, 107, 223, 0.2);
        }
        
        .button-group {
            display: flex;
            gap: 10px;
            margin: 25px 0;
        }
        
        button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        #calculateBtn {
            background-color: var(--primary-color);
            color: white;
        }
        
        #calculateBtn:hover {
            background-color: #3a5bd9;
            transform: translateY(-2px);
        }
        
        #resetBtn {
            background-color: var(--accent-color);
            color: white;
        }
        
        #resetBtn:hover {
            background-color: #e05555;
            transform: translateY(-2px);
        }
        
        .results {
            margin-top: 20px;
            padding: 20px;
            background-color: var(--secondary-color);
            border-radius: 12px;
            display: none;
        }
        
        .result-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed var(--border-color);
        }
        
        .result-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .highlight {
            font-size: 28px;
            color: var(--primary-color);
            font-weight: 700;
            margin: 5px 0;
        }
        
        .rate-item {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
        }
        
        .rate-value {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        /* 动画效果 */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .pulse {
            animation: pulse 1.5s infinite;
        }
        
        /* 移动端适配 */
        @media (max-width: 576px) {
            body {
                padding: 10px;
            }
            
            .calculator {
                padding: 20px 15px;
            }
            
            h1 {
                font-size: 1.5rem;
            }
            
            h2 {
                font-size: 1.2rem;
            }
            
            .highlight {
                font-size: 24px;
            }
            
            input, button {
                padding: 10px 12px;
            }
            
            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h1>💰 实时收入计算器 💰</h1>
        
        <div class="form-group">
            <label for="monthlySalary">月薪 (元)</label>
            <input type="number" id="monthlySalary" placeholder="请输入您的月薪" inputmode="numeric">
        </div>
        
        <div class="form-group">
            <label for="workDays">每月工作天数</label>
            <input type="number" id="workDays" placeholder="通常为22天" value="22" inputmode="numeric">
        </div>
        
        <div class="form-group">
            <label for="dailyHours">每天工作小时数</label>
            <input type="number" id="dailyHours" placeholder="通常为8小时" value="8" inputmode="numeric">
        </div>
        
        <div class="button-group">
            <button id="calculateBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                    <line x1="12" y1="2" x2="12" y2="6"></line>
                    <line x1="12" y1="18" x2="12" y2="22"></line>
                    <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
                    <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                    <line x1="2" y1="12" x2="6" y2="12"></line>
                    <line x1="18" y1="12" x2="22" y2="12"></line>
                    <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
                    <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                </svg>
                开始计算
            </button>
            <button id="resetBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                    <polyline points="1 4 1 10 7 10"></polyline>
                    <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                </svg>
                重置
            </button>
        </div>
        
        <div class="results" id="results">
            <h2>📊 计算结果</h2>
            
            <div class="result-item">
                <div>⏱️ 已工作时间:</div>
                <div id="timeWorked" class="highlight pulse">00:00:00</div>
            </div>
            
            <div class="result-item">
                <div>💰 当前收入:</div>
                <div id="currentEarnings" class="highlight pulse">0.00 元</div>
            </div>
            
            <div class="result-item">
                <div>⚡ 收入速率:</div>
                <div class="rate-item">
                    <span>每秒:</span>
                    <span id="perSecond" class="rate-value">0.0000 元</span>
                </div>
                <div class="rate-item">
                    <span>每分钟:</span>
                    <span id="perMinute" class="rate-value">0.00 元</span>
                </div>
                <div class="rate-item">
                    <span>每小时:</span>
                    <span id="perHour" class="rate-value">0.00 元</span>
                </div>
                <div class="rate-item">
                    <span>每天:</span>
                    <span id="perDay" class="rate-value">0.00 元</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        let timer;
        let startTime;
        let earningsPerSecond = 0;
        
        document.getElementById('calculateBtn').addEventListener('click', function() {
            // 获取输入值
            const monthlySalary = parseFloat(document.getElementById('monthlySalary').value);
            const workDays = parseFloat(document.getElementById('workDays').value);
            const dailyHours = parseFloat(document.getElementById('dailyHours').value);
            
            // 验证输入
            if (isNaN(monthlySalary)) {
                alert('请输入有效的月薪');
                return;
            }
            
            if (isNaN(workDays) || workDays <= 0 || workDays > 31) {
                alert('请输入有效的工作天数 (1-31)');
                return;
            }
            
            if (isNaN(dailyHours) || dailyHours <= 0 || dailyHours > 24) {
                alert('请输入有效的工作小时数 (1-24)');
                return;
            }
            
            // 计算收入速率
            const earningsPerDay = monthlySalary / workDays;
            const earningsPerHour = earningsPerDay / dailyHours;
            const earningsPerMinute = earningsPerHour / 60;
            earningsPerSecond = earningsPerMinute / 60;
            
            // 显示计算结果
            document.getElementById('perSecond').textContent = earningsPerSecond.toFixed(4) + ' 元';
            document.getElementById('perMinute').textContent = earningsPerMinute.toFixed(2) + ' 元';
            document.getElementById('perHour').textContent = earningsPerHour.toFixed(2) + ' 元';
            document.getElementById('perDay').textContent = earningsPerDay.toFixed(2) + ' 元';
            
            // 显示结果区域
            document.getElementById('results').style.display = 'block';
            
            // 开始计时
            startTime = new Date();
            updateTimer();
            timer = setInterval(updateTimer, 1000);
            
            // 添加动画效果
            document.getElementById('timeWorked').classList.add('pulse');
            document.getElementById('currentEarnings').classList.add('pulse');
        });
        
        document.getElementById('resetBtn').addEventListener('click', function() {
            // 停止计时
            clearInterval(timer);
            
            // 重置显示
            document.getElementById('timeWorked').textContent = '00:00:00';
            document.getElementById('currentEarnings').textContent = '0.00 元';
            document.getElementById('results').style.display = 'none';
            
            // 移除动画效果
            document.getElementById('timeWorked').classList.remove('pulse');
            document.getElementById('currentEarnings').classList.remove('pulse');
            
            // 清空输入
            document.getElementById('monthlySalary').value = '';
            document.getElementById('workDays').value = '22';
            document.getElementById('dailyHours').value = '8';
        });
        
        function updateTimer() {
            const now = new Date();
            const elapsedTime = (now - startTime) / 1000; // 秒
            
            // 计算工作时间
            const hours = Math.floor(elapsedTime / 3600);
            const minutes = Math.floor((elapsedTime % 3600) / 60);
            const seconds = Math.floor(elapsedTime % 60);
            
            // 格式化时间显示
            const formattedTime = 
                String(hours).padStart(2, '0') + ':' + 
                String(minutes).padStart(2, '0') + ':' + 
                String(seconds).padStart(2, '0');
            
            // 计算当前收入
            const currentEarnings = elapsedTime * earningsPerSecond;
            
            // 更新显示
            document.getElementById('timeWorked').textContent = formattedTime;
            document.getElementById('currentEarnings').textContent = currentEarnings.toFixed(2) + ' 元';
        }
    </script>
</body>
</html>