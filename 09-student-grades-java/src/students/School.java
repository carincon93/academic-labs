package students;

public class School {
    int count;
    float totalPayment;
    float avg;
    float greatestPayment;
    float diffAvg;

    void addStudent(Student student) {
        count++;
        this.calculateTotalPayment(student.payment);
        this.calculateGreatestPayment(student.payment);
        this.calculateAvg();
        this.calculateDiffAvg();
    }

    void calculateGreatestPayment(float payment) {
        if (greatestPayment < payment) {
            greatestPayment = payment;
        }
    }

    void calculateDiffAvg() {
        diffAvg = greatestPayment - avg;
    }

    float getDiffAvg() {
        return diffAvg;
    }

    void calculateTotalPayment(float payment) {
        totalPayment += payment;
    }

    void calculateAvg() {
        avg = (totalPayment / count);
    }
}
