export interface AnalyticsData {
    id: string;
    title: string;
    value: number;
    timestamp: Date;
}

export interface SlideContent {
    title: string;
    body: string;
    images?: string[];
}