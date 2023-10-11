 <style>
     .body {
         font-family: ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,"Apple Color Emoji","Segoe UI Emoji",Segoe UI Symbol,"Noto Color Emoji";
     }
     .maintenance-container {
        float: left;
        width: 50%;
         font-style: italic;
    }
     .maintenance-text {
        background-color: #808080;
        color: #ffffff;
        font-size: 2.25rem;
        line-height: 2.25rem;
        height: 100px;
        padding: 40px 15px 10px;
    }
     .maintenance-number {
         background-color: #d9d9d9;
         font-size: 1.875rem;
         line-height: 2.25rem;
         font-weight: bold;
         padding-left: 20px;
    }
     .company-logo {
         float: right;
         width: 50%;
         text-align: center;
     }
     .selvah-logo {
         width: 6rem;
     }
</style>

<div class="body">
    <div style="width: 100%">
        <div class="maintenance-container">
            <div class="maintenance-text">
                Fiche d'Intervention Maintenance
            </div>
            <div class="maintenance-number italic">
                N° {{ $maintenance->getKey() }}
            </div>
        </div>

        <div class="company-logo">
            <img src="{{ asset('images/logos/selvah_570x350.png') }}" alt="Selvah Logo" class="selvah-logo">
            <div class="" style="">
                <span style="font-weight: bold; font-size: 1.5rem;display: block">SELVAH SCICA SAS</span>
                <span style="display: block;">6 avenue du Président Borgeot</span>
                 <span style="display: block;">71350 Verdun sur le Doubs</span>
                <span style="display: block;">Tél. 03 85 91 93 00</span>
                <span style="display: block;">RCS Chalon sur Saône 840 297 345</span>
            </div>
        </div>
    </div>

</div>
