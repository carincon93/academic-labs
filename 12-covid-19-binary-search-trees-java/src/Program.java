import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;

public class Program {

    public static void main(String[] args) throws IOException {
        String[] dataPatient;

        PatientBinarySearchTree pbst = new PatientBinarySearchTree();

        BufferedReader bf = new BufferedReader(new FileReader("patients.txt"));

        int qtyPatients = Integer.parseInt(bf.readLine());

        for (int i = 0; i < qtyPatients; i++) {
            dataPatient = bf.readLine().split(",");
            String[] arrayString = new String[dataPatient.length - 2];
            for (int j = 0; j < dataPatient.length - 2; j++) {
                arrayString[j] = dataPatient[j + 2];
            }
            Patient patient = new Patient(Integer.parseInt(dataPatient[0]), dataPatient[1], arrayString);

            pbst.addPatient(patient);
        }

        System.out.println(pbst.feverCount + " patients have fever.");
        System.out.println("Payment average: " + pbst.getPaymentAverage());
        System.out.println("Patient with most symptoms: " + pbst.patientWithMostSymptoms.name);
        System.out.println(pbst.getPacientSymptomstById(3));
    }
}
