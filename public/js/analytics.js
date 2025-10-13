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

    // Add other charts (gender, yearLevel, reason, amountBuckets, course, college) using the same pattern
});
