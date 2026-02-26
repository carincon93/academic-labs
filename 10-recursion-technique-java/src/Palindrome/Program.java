package Palindrome;

public class Program {
    public static void main(String[] args) {
        int[] array = new int[]{5,8,5};
        int index = 0;
        int isPalindrome = palindrome(array, index, array.length);

        System.out.println(isPalindrome);
    }

    public static int palindrome(int[] numbersArray, int firstElement, int lastElement) {
        if(firstElement == numbersArray.length - 1 || numbersArray.length == 0) {
            return 1;
        }

        if(numbersArray[firstElement] == numbersArray[lastElement - 1]) {
            firstElement++;
            lastElement--;
        } else {
            return 0;
        }

        return palindrome(numbersArray, firstElement, lastElement);
    }
}
