public class PatientBinarySearchTree {
    PatientNode root;

    int feverCount = 0;
    int symptomsCount = 0;
    float totalPayment = 0;
    Patient patientWithMostSymptoms = null;

    public void addPatient(Patient patient) {
        if(root == null) {
            System.out.println(patient.name + " is added to the system.");
            root = new PatientNode(patient);
            qtyPatientsWithFever(root, patient);
            totalPayment(root, patient);
            patientWithMostSymptoms(root);
            return;
        }

        addPatient(root, patient);
        qtyPatientsWithFever(root, patient);
        totalPayment(root, patient);
        patientWithMostSymptoms(root);
    }

    private void  addPatient(PatientNode node, Patient patient) {
        if (node == null) {
            return;
        }
        if (checkIfExists(root, patient.id)) {
            if (node.patient.id < patient.id) {
                if (node.right == null) {
                    System.out.println(patient.name + " is added to the system.");
                    node.right = new PatientNode(patient);
                } else {
                    addPatient(node.right, patient);
                }
            } else {
                if (node.left == null) {
                    System.out.println(patient.name + " is added to the system.");
                    node.left = new PatientNode(patient);
                } else {
                    addPatient(root.left, patient);
                }
            }
        } else {
            System.out.println(patient.name + " is duplicated, so "+ patient.name+" couldn't be added to the system again.");
        }
    }

    private boolean checkIfExists(PatientNode node, int id) {
        if(node == null) {
            return false;
        }

        if(node.patient.id == id) {
            return false;
        }

        if(node.right != null) {
            return checkIfExists(node.right, id);
        }

        if(node.left != null) {
            return checkIfExists(node.left, id);
        }

        return true;
    }

    public String getPacientSymptomstById(int id) {
        return getPacientSymptomstById(root, id);
    }

    private String getPacientSymptomstById(PatientNode node, int id) {
        if(node == null) {
            return null;
        }

        if(node.patient.id == id) {
            String str = String.join(",", node.patient.symptoms);
            return node.patient.name + "'s symptoms: " + str;
        }

        if(node.right != null) {
            return getPacientSymptomstById(node.right, id);
        }

        return getPacientSymptomstById(node.left, id);
    }

    private int qtyPatientsWithFever(PatientNode node, Patient patient) {
        if(node == null) {
            return 0;
        }

        if(node.right != null) {
            return qtyPatientsWithFever(node.right, patient);
        }

        if(node.left != null) {
            return qtyPatientsWithFever(node.left, patient);
        }

        symptomsCount += patient.symptoms.length;
        for (String symptom: patient.symptoms) {
            if(symptom.contains("fever")) {
                feverCount++;
            }
        }
        return feverCount;
    }

    public String mostCommonSymptom() {
        return "Test";
    }

    private float totalPayment(PatientNode node, Patient patient) {
        if(node == null) {
            return 0;
        }

        if(node.right != null) {
            return totalPayment(node.right, patient);
        }

        if(node.left != null) {
            return totalPayment(node.left, patient);
        }

        totalPayment += (patient.symptoms.length * 100);

        return totalPayment;
    }

    public float getPaymentAverage() {
        return totalPayment / symptomsCount;
    }

    public Patient patientWithMostSymptoms(PatientNode node) {
        if(node == null) {
            return null;
        }

        Patient rightPatientWithMostSymptoms = null;
        if(node.right != null) {
            rightPatientWithMostSymptoms = patientWithMostSymptoms(node.right);
        }

        Patient leftPatientWithMostSymptoms = null;
        if(node.left != null) {
            leftPatientWithMostSymptoms = patientWithMostSymptoms(node.left);
        }

        patientWithMostSymptoms = node.patient;
        if(rightPatientWithMostSymptoms != null) {
            if(patientWithMostSymptoms.symptoms.length <= rightPatientWithMostSymptoms.symptoms.length) {
                patientWithMostSymptoms = rightPatientWithMostSymptoms;
            }
        }

        if(leftPatientWithMostSymptoms != null) {
            if(leftPatientWithMostSymptoms.symptoms.length >= patientWithMostSymptoms.symptoms.length) {
                patientWithMostSymptoms = leftPatientWithMostSymptoms;
            }
        }

        return patientWithMostSymptoms;
    }
}
