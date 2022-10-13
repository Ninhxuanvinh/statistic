@extends('statistic::layouts.master')
@section('content')
    <div class="container-fluid p-20">
        <div class="row">
            <div class="col-sm-0">
                <h3>Biểu đồ chill cực mạnh</h3>
            </div>
            <div class="col-sm-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </nav>

                <div>
                    <div class="row">
                        <div class="col-sm-6" id="site1"></div>
                        <div class="col-sm-6" id="site2"></div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-4" id="site3"></div>
                        <div class="col-sm-4" id="site4"></div>
                        <div class="col-sm-4" id="site5"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function solve(input) {
            const replaceWith = '"';
            return input.replace(/&quot;/g, replaceWith);
        }
        let x = '{{$dataSite}}'
        let data = JSON.parse(solve(x));

        function filterSite(site){
            return data.filter(item => {
                return item.sites_name === site;
            });
        }

        function sortSiteByDate(site){
            return site.sort(function(a,b){
                return new Date(a.date) - new Date(b.date);
            });
        }

        let site1 = sortSiteByDate(filterSite("site1"));
        let site2 = sortSiteByDate(filterSite("site2"));
        let site3 = sortSiteByDate(filterSite("site3"));
        let site4 = sortSiteByDate(filterSite("site4"));
        let site5 = sortSiteByDate(filterSite("site5"));

        function customChart(site, siteName){
            let idChart  = "#"+siteName;
            let jobs_all = site.map(item => {
                return item.jobs_all;
            })

            let jobs_public = site.map(item => {
                return item.jobs_public;
            })

            let jobs_duplicated = site.map(item => {
                return item.jobs_duplicated;
            })

            let date = site.map(item => {
                return item.date;
            })

            let options = {
                series: [
                    {
                        name : 'jobs_all',
                        data : jobs_all
                    },
                    {
                        name : 'jobs_duplicated',
                        data : jobs_duplicated
                    },
                    {
                        name : 'jobs_public',
                        data : jobs_public
                    },
                ],
                chart: {
                    height: 380,
                    width: "100%",
                    type: "line"
                },
                xaxis : {
                    categories: date,
                    type: "datetime",
                    labels: {
                        datetimeUTC: false
                    }
                },
                markers: {
                    size: 5,
                },
                title: {
                    text: siteName,
                    align: 'left',
                    margin: 10,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize:  '14px',
                        fontWeight:  'bold',
                        fontFamily:  undefined,
                        color:  '#263238'
                    },
                }

            }

            let chart = new ApexCharts(document.querySelector(idChart), options);

            chart.render();
        }

        customChart(site1, "site1")
        customChart(site2, "site2")
        customChart(site3, "site3")
        customChart(site4, "site4")
        customChart(site5, "site5")

    </script>
@endsection
