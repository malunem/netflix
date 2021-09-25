<div id="loader" class="spinner-border text-success" role="status">
    <span class="visually-hidden">Loading...</span>
</div>

<style>
    #loader{
        width: 100vw;
        height: 100vh;
    }
</style>

<script> 

    /* let loaded = false; */

    /* if (loaded == false) {
        document.getElementById('loader').classList.remove('d-none'); 
    } */

    window.addEventListener('DOMContentLoaded', (event)=>{
      document.getElementById('loader').style.display = 'none'; 
      /* loaded = true; */
    }); 
</script> 