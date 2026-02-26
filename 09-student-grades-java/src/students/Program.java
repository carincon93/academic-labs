package students;

public class Program {

    public static void main(String[] args) {
        School school = new School();
        Student student1 = new Student();
        student1.name = "Cristian";
        student1.age = 27;
        student1.payment = 500;
        school.addStudent(student1);

        Student student2 = new Student();
        student2.name = "Camila";
        student2.age = 32;
        student2.payment = 300;
        school.addStudent(student2);

        Student student3 = new Student();
        student3.name = "Fernando";
        student3.age = 45;
        student3.payment = 1600;
        school.addStudent(student3);

        System.out.println("Difference between payment average and student with the greatest payment is: "+school.getDiffAvg());
    }

}
