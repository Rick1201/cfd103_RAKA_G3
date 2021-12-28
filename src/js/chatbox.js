// 聊天機器人
var content = document.getElementById("content");
        var box = document.getElementById("cbox");
        var remote = document.getElementById("remote");
        var local = document.getElementById("local");
        var scollDown = document.getElementById("scollDown");
        var qa = [
            'RAKA是我們的品牌',
            '台灣是一個好地方',
            '您好歡迎光臨',
            '潛水錶就是能在水裡潛水用的手錶哦',
            '緯育提把你',
            '購物車在這邊'
        ];

        var qa2 = [
            {
                value: 'RAKA是我們的品牌',
                essential: ['RAKA','品牌'],
            },
            {
                value: '潛水錶就是潛水用的手錶哦',
                essential: ['潛水錶','手錶'],
            },
            {
                value: '購物車在這邊',
                essential: ['購物車','買單'],
            },
            {
                value: '客製化潛水錶',
                essential: ['客製化','客製化潛水錶'],
            },
            {
                value: '會員登入',
                essential: ['登入','會員'],
            },
        ];



        function getAnswer(input){
            for (let i =0; i< qa2.length; i++) {
                if (qa2[i].essential.includes(input))
                    return qa2[i].value
            }
            
        }
          
        
        
        function keyEnter(){
            if(window.event.keyCode==13){
                check();
            }
        }

        function answer(ans){
            
            let time = new Date();
            let h = time.getHours();
            let m = time.getMinutes();
            let s = time.getSeconds();
            let filterQa = getAnswer(ans);
            console.log(filterQa);

                if(!filterQa || filterQa.length <= 0){
            box.innerHTML = box.innerHTML + `
            <div id="remote" class="user remote">
                <div class="picbox">
                    <div class="name">
                        客服小Ｒ
                        </div>
                    <div class="pic">
                        <img src="./images/navy.jpg" alt="">
                    </div>
                </div>
        
                <div class="txt">
                    建議輸入關鍵字”購物車“、”RAKA“...
                    <div class="timeHm">${h}:${m}:${s}</div>
                </div>
            </div>
            `;
            box.scrollTop = box.scrollHeight;
        } else{
           
            box.innerHTML = box.innerHTML + `
            <div id="remote" class="user remote">
                <div class="picbox">
                    <div class="name">
                        客服小Ｒ
                        </div>
                    <div class="pic">
                        <img src="navy.jpg" alt="">
                    </div>
                </div>
        
                <div class="txt">
                    ${filterQa}
                    <div class="timeHm">${h}:${m}:${s}</div>
                </div>
            </div>
            `;
            box.scrollTop = box.scrollHeight;
            }
            
        }
        function check(){
            let time = new Date();
            let h = time.getHours();
            let m = time.getMinutes();
            let s = time.getSeconds();


                if(content.value.length>0){
                    box.innerHTML = box.innerHTML + 
                    `
                        <div id="local" class="user local">
                            <div class="txt">
                                ${content.value}
                                <div class="timeHm">
                                ${h}:${m}:${s}
                                </div>
                            </div>
                        </div>
                    `;

            let ans = content.value
            setTimeout(() => {

                answer(ans);
            }, 1000);
            content.value ="";
            box.scrollTop = box.scrollHeight;
            }
        };
        function init(){
            document.getElementById("btn").onclick = check;
            document.onkeypress = keyEnter;
            
            
        };
        window.addEventListener("load",init,false);
