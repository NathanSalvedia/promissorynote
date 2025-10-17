import { ImportAnalytics } from './analytics/import';
import { PowerPointGenerator } from './presentation/powerpoint';
import { AnalyticsData, SlideContent } from './types';

const main = async () => {
    const analyticsImporter = new ImportAnalytics();
    const data: AnalyticsData = await analyticsImporter.importData('source-url-or-path');

    const pptGenerator = new PowerPointGenerator();
    
    data.slides.forEach((slideData: SlideContent) => {
        const slide = pptGenerator.createSlide();
        pptGenerator.addContent(slide, slideData);
    });

    // Save or export the PowerPoint presentation as needed
};

main().catch(error => {
    console.error('Error during the analytics import and PowerPoint generation:', error);
});