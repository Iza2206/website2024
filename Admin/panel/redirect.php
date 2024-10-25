<div class="content-wrapper">
<p class="font-weight-light text-center">Anda telah berhasil logout, website akan diredirect dalam 
    <span id="counter">2</span> detik.</p>
</div>
   <script type="text/javascript">
        function countdown() {
            var i = document.getElementById('counter');
            if (parseInt(i.innerHTML)<=0) {
                location.href = 'login';
            }
            if (parseInt(i.innerHTML)!=0) {
                i.innerHTML = parseInt(i.innerHTML)-1;
            }
        }
        setInterval(function(){ countdown(); },1000);
    </script>