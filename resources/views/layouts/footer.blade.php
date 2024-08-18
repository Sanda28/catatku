<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2023</span>
        </div>
    </div>
</footer>
<style>
    @media only screen and (max-width: 768px) {
        table thead {
            display: none;
        }
        table, table tbody, table tr, table td {
            display: block;
            width: 100%;
        }
        table tr {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            padding: 10px;
        }
        table td {
            text-align: right;
            padding-left: 50%;
            position: relative;
        }
        table td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 50%;
            padding-left: 15px;
            font-weight: bold;
            text-align: left;
        }
    }
    </style>
