package GreatestElement;

public class Program {
    public static int gretestElement = 0;

    public static void main(String[] args) {
        int[] array = new int[]{3, 7, 25, 13};
        int greatestElement = greatestElement(array, 0, 0);

        System.out.println("Greatest: "+greatestElement);
    }

    public static int greatestElement(int[] numbersArray, int currentIndex, int index) {
        if(index == numbersArray.length - 1) {
            if (currentIndex == index) {
                return gretestElement;
            }
            index = 0;
            currentIndex++;
        }

        if(numbersArray[currentIndex] > gretestElement) {
            gretestElement = numbersArray[currentIndex];
        }

        return greatestElement(numbersArray, currentIndex, index+1);
    }
}
