document.addEventListener("DOMContentLoaded", function() {
        const ad = window.analyticsData || {};

        const baseAnimation = { enabled: true, easing: 'easeinout', speed: 800, animateGradually: { enabled: true, delay: 150 }, dynamicAnimation: { enabled: true, speed: 400 } };
        const tooltipTheme = { theme: 'light', style: { fontSize: '13px' } };

        // Status
        const statusSeries = [
            ad.statusCounts?.pending ?? ad.statusCounts?.Pending ?? 0,
            ad.statusCounts?.approved ?? ad.statusCounts?.Approved ?? 0,
            ad.statusCounts?.rejected ?? ad.statusCounts?.Rejected ?? 0
        ];
        new ApexCharts(document.querySelector("#statusChart"), {
            chart: { type: 'pie', height: 300, animations: baseAnimation },
            series: statusSeries,
            labels: ['Pending', 'Approved', 'Rejected'],
            tooltip: tooltipTheme
        }).render();

        // Payment progress (fully / partial / unpaid)
        new ApexCharts(document.querySelector("#paymentChart"), {
            chart: { type: 'pie', height: 300, animations: baseAnimation },
            series: [ad.payments?.fullyPaid ?? 0, ad.payments?.partial ?? 0, ad.payments?.unpaid ?? 0],
            labels: ['Fully Paid', 'Partially Paid', 'Unpaid'],
            tooltip: tooltipTheme
        }).render();

        // Department toggle (counts / amounts) with gradient fill
        const deptLabels = ad.department?.labels ?? [];
        const deptCounts = ad.department?.counts ?? [];
        const deptAmounts = ad.department?.amounts ?? [];
        let deptType = 'count';
        let deptChart = new ApexCharts(document.querySelector("#departmentChart"), {
            chart: { type: 'bar', height: 300, animations: baseAnimation },
            series: [{ name: 'Applications', data: deptCounts }],
            xaxis: { categories: deptLabels },
            colors: ['#b91c1c'],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: "vertical",
                    gradientToColors: ['#ef4444'],
                    opacityFrom: 0.9,
                    opacityTo: 1,
                    stops: [0, 90, 100]
                }
            },
            plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } },
            dataLabels: { enabled: true, style: { colors: ['#ffffff'], fontWeight: '700' } },
            tooltip: tooltipTheme
        });
        deptChart.render();
        const toggleBtn = document.getElementById('toggleDept');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                deptType = deptType === 'count' ? 'amount' : 'count';
                deptChart.updateOptions({
                    series: [{ name: deptType === 'count' ? 'Applications' : 'Total Amount (₱)', data: deptType === 'count' ? deptCounts : deptAmounts }],
                colors: ['#b91c1c'],
                fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: "vertical",
                    gradientToColors: ['#ef4444'],
                    opacityFrom: 0.9,
                    opacityTo: 1,
                    stops: [0, 90, 100]
                }
            },
                    dataLabels: { enabled: true, style: { colors: ['#ffffff'], fontWeight: '700' } }
                });
            });
        }

        // Monthly line
        new ApexCharts(document.querySelector("#monthlyChart"), {
            chart: { type: 'line', height: 300, animations: baseAnimation },
            series: [{ name: 'Submissions', data: ad.monthly?.data ?? [] }],
            xaxis: { categories: ad.monthly?.labels ?? [] },
            tooltip: tooltipTheme
        }).render();

        // Gender Distribution
        new ApexCharts(document.querySelector("#genderChart"), {
            chart: { type: 'pie', height: 300, animations: baseAnimation },
            series: Object.values(ad.gender ?? {}),
            labels: Object.keys(ad.gender ?? {}),
            tooltip: tooltipTheme
        }).render();

                // Partial Payment Amount Distribution
        new ApexCharts(document.querySelector("#partialamountChart"), {
            chart: { type: 'bar', height: 300, animations: baseAnimation },
            series: [{ name: 'Partial Payments', data: Object.values(ad.partialPaymentBuckets ?? {}) }],
            xaxis: { categories: Object.keys(ad.partialPaymentBuckets ?? {}) },
            colors: ['#dc2626'], // red tone for partial
            plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } },
            dataLabels: { enabled: true, style: { colors: ['#ffffff'], fontWeight: '700' } },
            tooltip: tooltipTheme
        }).render();

        // Downpayment Amount Distribution
       // Amount Distribution (from promissory note form values)
        new ApexCharts(document.querySelector("#downpaymentamountChart"), {
            chart: { type: 'bar', height: 300, animations: baseAnimation },
            series: [{ name: 'Applications', data: Object.values(ad.amountBuckets ?? {}) }],
            xaxis: { categories: Object.keys(ad.amountBuckets ?? {}) },
            colors: ['#2563eb'],
            plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } },
            dataLabels: { enabled: true, style: { colors: ['#ffffff'], fontWeight: '700' } },
            tooltip: tooltipTheme
        }).render();


        // Year Level Distribution
        new ApexCharts(document.querySelector("#yearLevelChart"), {
            chart: { type: 'bar', height: 300, animations: baseAnimation },
            series: [{ name: 'Applications', data: Object.values(ad.yearLevel ?? {}) }],
            xaxis: { categories: Object.keys(ad.yearLevel ?? {}) },
            colors: ['#059669'],
            plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } },
            dataLabels: { enabled: true, style: { colors: ['#ffffff'], fontWeight: '700' } },
            tooltip: tooltipTheme
        }).render();

                // Reason Chart (include 'Other' custom text values)
        new ApexCharts(document.querySelector("#reasonChart"), {
            chart: { type: 'bar', height: 300, animations: baseAnimation },
            series: [{ name: 'Applications', data: Object.values(ad.reason ?? {}) }],
            xaxis: { categories: Object.keys(ad.reason ?? {}) },
            colors: ['#9333ea'],
            plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } },
            dataLabels: { enabled: true, style: { colors: ['#ffffff'], fontWeight: '700' } },
            tooltip: tooltipTheme
        }).render();

                // Other Reasons Chart (only "Other" category entries)
        new ApexCharts(document.querySelector("#otherReasonChart"), {
        chart: { type: 'bar', height: 300, animations: baseAnimation },
        series: [{ name: 'Applications', data: Object.values(ad.otherReasons ?? {}) }],
        xaxis: { categories: Object.keys(ad.otherReasons ?? {}) },
        colors: ['#16a34a'],
        plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } },
        dataLabels: { enabled: true, style: { colors: ['#ffffff'], fontWeight: '700' } },
        tooltip: tooltipTheme
        }).render();

                // College Courses Chart
        new ApexCharts(document.querySelector("#collegeCourseChart"), {
            chart: { type: 'bar', height: 300, animations: baseAnimation },
            series: [{ name: 'Students', data: Object.values(ad.collegeCourses ?? {}) }],
            xaxis: { categories: Object.keys(ad.collegeCourses ?? {}) },
            colors: ['#dc2626'],
            plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } },
            dataLabels: { enabled: true, style: { colors: ['#ffffff'], fontWeight: '700' } },
            tooltip: tooltipTheme
        }).render();

                // Promissory Notes per Academic Term
        new ApexCharts(document.querySelector("#termChart"), {
            chart: { type: 'bar', height: 300, animations: baseAnimation },
            series: [{ name: 'Promissory Notes', data: Object.values(ad.perTerm ?? {}) }],
            xaxis: { categories: Object.keys(ad.perTerm ?? {}) },
            colors: ['#f59e0b'],
            plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } },
            dataLabels: { enabled: true, style: { colors: ['#ffffff'], fontWeight: '700' } },
            tooltip: tooltipTheme
        }).render();

        // Promissory Notes per Semester
        new ApexCharts(document.querySelector("#semesterChart"), {
            chart: { type: 'bar', height: 300, animations: baseAnimation },
            series: [{ name: 'Promissory Notes', data: Object.values(ad.perSemester ?? {}) }],
            xaxis: { categories: Object.keys(ad.perSemester ?? {}) },
            colors: ['#84cc16'],
            plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } },
            dataLabels: { enabled: true, style: { colors: ['#ffffff'], fontWeight: '700' } },
            tooltip: tooltipTheme
        }).render();

        // Promissory Notes per Academic Year
        new ApexCharts(document.querySelector("#acadYearChart"), {
            chart: { type: 'bar', height: 300, animations: baseAnimation },
            series: [{ name: 'Promissory Notes', data: Object.values(ad.perAcademicYear ?? {}) }],
            xaxis: { categories: Object.keys(ad.perAcademicYear ?? {}) },
            colors: ['#0ea5e9'],
            plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } },
            dataLabels: { enabled: true, style: { colors: ['#ffffff'], fontWeight: '700' } },
            tooltip: tooltipTheme
        }).render();

        // Downpayment Amount Distribution (from promissory note database)
        // ad.downpaymentBuckets should be an object: { '0-500': 10, '501-1000': 7, ... }
        if (ad.downpaymentBuckets) {
            new ApexCharts(document.querySelector("#downpaymentChart"), {
                chart: { type: 'bar', height: 300, animations: baseAnimation },
                series: [{ name: 'Applications', data: Object.values(ad.downpaymentBuckets) }],
                xaxis: { categories: Object.keys(ad.downpaymentBuckets) },
                colors: ['#eab308'],
                plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } },
                dataLabels: { enabled: true, style: { colors: ['#ffffff'], fontWeight: '700' } },
                tooltip: tooltipTheme
            }).render();
        }

        // Add other charts (course, college) using the same pattern
    });
