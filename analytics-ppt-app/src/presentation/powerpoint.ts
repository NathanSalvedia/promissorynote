export class PowerPointGenerator {
    private slides: any[];

    constructor() {
        this.slides = [];
    }

    createSlide(title: string): void {
        const slide = { title, content: [] };
        this.slides.push(slide);
    }

    addContent(slideIndex: number, content: string): void {
        if (this.slides[slideIndex]) {
            this.slides[slideIndex].content.push(content);
        } else {
            throw new Error("Slide not found");
        }
    }

    getSlides(): any[] {
        return this.slides;
    }
}