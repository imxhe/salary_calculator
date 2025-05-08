<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>实时收入计算器 - 打工人的时间提款‪机‬</title>
    <style>
        :root {
            --primary-color: #4a6bdf;
            --secondary-color: #f8f9fa;
            --accent-color: #ff6b6b;
            --success-color: #4cc9f0;
            --text-color: #2b2d42;
            --light-text: #8d99ae;
            --border-color: #edf2f4;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --card-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
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
            background-color: #f8f9fa;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .page {
            width: 100%;
            background-color: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
            transition: all 0.3s ease;
            display: none;
        }
        
        .page.active {
            display: block;
        }
        
        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 25px;
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        h2 {
            color: var(--primary-color);
            font-size: 1.4rem;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-color);
        }
        
        input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }
        
        .button-group {
            display: flex;
            gap: 12px;
            margin: 30px 0 15px;
        }
        
        button {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #3a56d4;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.25);
        }
        
        .btn-accent {
            background-color: var(--accent-color);
            color: white;
        }
        
        .btn-accent:hover {
            background-color: #e05555;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(247, 37, 133, 0.25);
        }
        
        .btn-success {
            background-color: var(--success-color);
            color: white;
        }
        
        .btn-success:hover {
            background-color: #379ebe;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 201, 240, 0.25);
        }
        
        /* 结果页面特殊样式 */
        .result-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .earning-display {
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            color: white;
            padding: 30px;
            border-radius: 16px;
            text-align: center;
            margin: 10px 0 25px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }
        
        .earning-display::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            animation: rotate 15s linear infinite;
        }
        
        .current-earning-amount {
            font-size: 3.2rem;
            font-weight: 800;
            margin: 10px 0;
            position: relative;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .current-earning-label {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
        }
        
        .time-display {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 15px 0;
            position: relative;
        }
        
        .time-segment {
            background-color: rgba(255,255,255,0.15);
            padding: 10px 15px;
            border-radius: 10px;
            text-align: center;
            min-width: 70px;
        }
        
        .time-value {
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .time-label {
            font-size: 0.8rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .rate-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 10px;
        }
        
        .rate-card {
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
            transition: transform 0.3s;
        }
        
        .rate-card:hover {
            transform: translateY(-5px);
        }
        
        .rate-value {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 5px 0;
        }
        
        .rate-label {
            font-size: 0.9rem;
            color: var(--light-text);
        }
        
        .divider {
            height: 1px;
            background-color: var(--border-color);
            margin: 20px 0;
            position: relative;
        }
        
        .divider::after {
            content: "收入速率";
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 0 15px;
            color: var(--light-text);
            font-size: 0.9rem;
        }
        
        /* 动画效果 */
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.03); }
            100% { transform: scale(1); }
        }
        
        .pulse {
            animation: pulse 2.5s infinite;
        }
        
        /* 移动端适配 */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            .page {
                padding: 25px 20px;
            }
            
            h1 {
                font-size: 1.6rem;
            }
            
            .current-earning-amount {
                font-size: 2.4rem;
            }
            
            .time-segment {
                min-width: 60px;
                padding: 8px 12px;
            }
            
            .time-value {
                font-size: 1.4rem;
            }
            
            .rate-grid {
                grid-template-columns: 1fr;
            }
            
            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- 输入页面 -->
        <div class="page active" id="input-page">
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
                <button id="calculateBtn" class="btn-primary">
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
                <button id="resetBtn" class="btn-accent">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
						<polyline points="1 4 1 10 7 10"></polyline>
						<path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
					</svg>
                    重置
                </button>
            </div>
        </div>
        
        <!-- 结果页面 -->
        <div class="page" id="result-page">
            <div class="result-container">
                <h1>您的实时收入</h1>
                
                <div class="earning-display pulse">
                    <div class="current-earning-label">累计收入</div>
                    <div class="current-earning-amount" id="currentEarnings">0.00 元</div>
                    
                    <div class="time-display">
                        <div class="time-segment">
                            <div class="time-value" id="hours">00</div>
                            <div class="time-label">小时</div>
                        </div>
                        <div class="time-segment">
                            <div class="time-value" id="minutes">00</div>
                            <div class="time-label">分钟</div>
                        </div>
                        <div class="time-segment">
                            <div class="time-value" id="seconds">00</div>
                            <div class="time-label">秒</div>
                        </div>
                    </div>
                    
                    <div class="current-earning-label">每秒: <span id="perSecond">0.0000</span> </div>
                </div>
                
                <div class="divider"></div>
                
                <div class="rate-grid">
                    <div class="rate-card">
                        <div class="rate-value" id="perMinute">0.00 元</div>
                        <div class="rate-label">每分钟收入</div>
                    </div>
                    <div class="rate-card">
                        <div class="rate-value" id="perHour">0.00 元</div>
                        <div class="rate-label">每小时收入</div>
                    </div>
                    <div class="rate-card">
                        <div class="rate-value" id="perDay">0.00 元</div>
                        <div class="rate-label">每日收入</div>
                    </div>
                    <div class="rate-card">
                        <div class="rate-value" id="perMonth">0.00 元</div>
                        <div class="rate-label">每月收入</div>
                    </div>
                </div>
                
                <div class="button-group">
                    <button id="backBtn" class="btn-accent">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
							<polyline points="1 4 1 10 7 10"></polyline>
							<path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
						</svg>
                        返回修改
                    </button>
                    <button id="restartBtn" class="btn-success">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
							<polyline points="1 4 1 10 7 10"></polyline>
							<path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
						</svg>
                        重新计时
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let timer;
        let startTime;
        let earningsPerSecond = 0;
        let monthlySalary = 0;
        
        // 切换到结果页面
        function showResultPage() {
            document.getElementById('input-page').classList.remove('active');
            document.getElementById('result-page').classList.add('active');
        }
        
        // 切换到输入页面
        function showInputPage() {
            document.getElementById('result-page').classList.remove('active');
            document.getElementById('input-page').classList.add('active');
        }
        
        // 开始计算
        document.getElementById('calculateBtn').addEventListener('click', function() {
            // 获取输入值
            monthlySalary = parseFloat(document.getElementById('monthlySalary').value);
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
            document.getElementById('perMonth').textContent = monthlySalary.toFixed(2) + ' 元';
            
            // 切换到结果页面
            showResultPage();
            
            // 开始计时
            startTime = new Date();
            updateTimer();
            timer = setInterval(updateTimer, 1000);
        });
        
        // 返回修改
        document.getElementById('backBtn').addEventListener('click', function() {
            // 停止计时
            clearInterval(timer);
            showInputPage();
        });
        
        // 重新计时
        document.getElementById('restartBtn').addEventListener('click', function() {
            // 停止当前计时
            clearInterval(timer);
            
            // 重置显示
            document.getElementById('currentEarnings').textContent = '0.00 元';
            document.getElementById('hours').textContent = '00';
            document.getElementById('minutes').textContent = '00';
            document.getElementById('seconds').textContent = '00';
            
            // 重新开始计时
            startTime = new Date();
            updateTimer();
            timer = setInterval(updateTimer, 1000);
        });
        
        // 重置
        document.getElementById('resetBtn').addEventListener('click', function() {
            // 停止计时
            clearInterval(timer);
            
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
            
            // 更新时间显示
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
            
            // 计算当前收入
            const currentEarnings = elapsedTime * earningsPerSecond;
            
            // 更新收入显示
            document.getElementById('currentEarnings').textContent = currentEarnings.toFixed(2) + ' 元';
        }
    </script>
</body>
</html>
