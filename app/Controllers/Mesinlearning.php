<?php namespace App\Controllers;

use Phpml\Classification\KNearestNeighbors;
use Phpml\Regression\LeastSquares;
use Phpml\Association\Apriori;
use Phpml\Clustering\KMeans;
use Phpml\Classification\MLPClassifier;
use Phpml\NeuralNetwork\ActivationFunction\PReLU;
use Phpml\NeuralNetwork\ActivationFunction\Sigmoid;
use Phpml\Metric\Accuracy;
use Phpml\Metric\Regression; //untuk regresi
use Phpml\Metric\ConfusionMatrix;
use Phpml\Regression\SVR;
use Phpml\SupportVectorMachine\Kernel;

use App\Models\MesinlearningModel;


class Mesinlearning extends BaseController
{
    public function __construct()
    {
		session_start();
        //load kelas MesinlearningModel
        $this->MesinlearningModel = new MesinlearningModel();
    }

	public function cobaMLPP(){
		// 4 nodes in input layer, 2 nodes in first hidden layer and 3 possible labels.
		//$mlp = new MLPClassifier(4, [2], ['a', 'b', 'c']);
		//tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }

		$mlp = new MLPClassifier(4, [[2, new PReLU], [2, new Sigmoid]], ['a', 'b', 'c']);
		$samples_value = [[1, 0, 0, 0], [0, 1, 1, 0], [1, 1, 1, 1], [0, 0, 0, 0]];
		$labels_value = ['a', 'a', 'b', 'c']; //label asli


		$mlp->train(
			$samples = $samples_value,
			$targets = $labels_value
		);

		$mlp->setLearningRate(0.1);

		//hasil akurasi pada training
		$label_prediksi = $mlp->predict($samples_value); //label prediksi

		$data['Hasil'] = $mlp->predict([[1, 1, 1, 1], [0, 0, 0, 0]]);
		$data['Samples'] = $samples_value;
		$data['Labels'] = $labels_value;
		$data['Prediksi'] = $label_prediksi;

		//$actualLabels = ['a', 'b', 'a', 'b'];
		//$predictedLabels = ['a', 'a', 'a', 'b'];

		$data['Akurasi'] = Accuracy::score($labels_value, $label_prediksi);
		// return 0.75

		//Accuracy::score($actualLabels, $predictedLabels, false);

		//$data['Hasil'] = $classifier->predict([163, 59]);
		//return view('welcome_message');
		return view('Mesinlearning/MLP', $data);

	}

	public function index()
	{
		//tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
		$samples = [[170, 55], [168, 70], [175, 68], [164, 60], [155, 44], [165, 50], [150, 45], [152, 60]];
		$labels = ['L', 'L', 'L', 'L', 'P', 'P', 'P', 'P'];
		$classifier = new KNearestNeighbors();
		$classifier->train($samples, $labels); //sampel adalah atribut input, sedangkan label adalah atribut output
		$data['Samples'] = $samples;
		$data['Labels'] = $labels;
		
		$data['Hasil'] = $classifier->predict([163, 59]);
		//return view('welcome_message');
		return view('Mesinlearning/klasifikasi', $data);
	}

	public function cobaregresi()
	{
		//tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
		$samples = [[0], [8], [15], [22]];
		$targets = [32, 46.4, 15, 22]; //target data aktual

		$regression = new LeastSquares();
		$regression->train($samples, $targets); //prediksi
		$data['Samples'] = $samples;
		$data['Targets'] = $targets;
		$data['Prediksi'] = $regression->predict($samples);
		$data['Hasil'] = $regression->predict([163, 59]);

		//parameter evaluasi
		$data['Akurasi_MSE'] = Regression::meanSquaredError($data['Targets'], $data['Prediksi']);
		$data['Akurasi_MSLE'] =Regression::meanSquaredLogarithmicError($data['Targets'], $data['Prediksi']);
		$data['Akurasi_MAE'] = Regression::meanAbsoluteError($data['Targets'], $data['Prediksi']);
		//return view('welcome_message');
		return view('Mesinlearning/regresi', $data);
	}

	public function cobaasosiasi()
	{
		//tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
		$samples = [['Bread', 'Milk'], ['Bread', 'Diaper', 'Beer', 'Eggs'], ['Milk', 'Diaper', 'Beer', 'Coke'], ['Bread', 'Milk', 'Diaper', 'Beer'], ['	Bread', 'Milk', 'Diaper', 'Coke']];
		$labels  = [];

		$associator = new Apriori($support = 0.4, $confidence = 0.6);
		$associator->train($samples, $labels);
		$data['Samples'] = $samples;
		$data['Rules'] = $associator->getRules();

		//return view('welcome_message');
		return view('Mesinlearning/asosiasi', $data);
	}

	public function cobacluster(){
		//tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
		$samples = [[1, 1], [8, 7], [1, 2], [7, 8], [2, 1], [8, 9]];
		$kmeans = new KMeans(2, KMeans::INIT_RANDOM);
		$data['Samples'] = $samples;
		$data['Cluster'] = $kmeans->cluster($samples);

		return view('Mesinlearning/kluster', $data);
	}

	public function proyeksirevenue(){
		//tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
		$data['hasil'] = $this->MesinlearningModel->getDataPrediksiPenjualan();

		$jml = count($data['hasil']);
		//echo $jml;
		
		$array_revenue = array();
		$samples = array();
		$targets = array();
		$i = 1;
		foreach($data['hasil'] as $dt){
			array_push($array_revenue,$dt->revenue);
			if($i<$jml){
				$ardata = array();
				array_push($ardata,$dt->revenue);
				array_push($samples,$ardata);
			}
			$i++;
		}
		$i = 1; 
		foreach($data['hasil'] as $dt){
			if($i<count($array_revenue)){
				array_push($targets,$array_revenue[$i]);
			}
			$i++;
		}
		/*
		echo "<pre>";
		print_r($samples);
		echo "</pre>";
		echo "<hr>";
		echo "<pre>";
		print_r($targets);
		echo "</pre>";
		*/
		
		$regression = new LeastSquares();
		$regression->train($samples, $targets);
		//echo "Prediksi [".$hasil[$jml-1]->revenue."]= ".ROUND($regression->predict([$hasil[$jml-1]->revenue]));
		$data['Proyeksi'] = ROUND($regression->predict([$data['hasil'][$jml-1]->revenue]));
		//$regression->predict([163, 59]);
		

		return view('Mesinlearning/proyeksipenjualan', $data);
	}

	//--------------------------------------------------------------------


	public function cobaKNN(){
		//tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
		$samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]]; //materi pembelajaran
		$labels = ['a', 'a', 'a', 'b', 'b', 'b']; //label aktual

		$classifier = new KNearestNeighbors();
		$classifier->train($samples, $labels);
		echo "Prediksi untuk 3, 2 = ".$classifier->predict([3, 2]);

		//akurasi 
		$hasil_prediksi = $classifier->predict([[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]]);
		echo "<br>";
		echo "Akurasi = ".Accuracy::score($labels, $hasil_prediksi); //nilai 0 s/d 1 
		echo "<br>";
		echo "<pre>";
		print_r(ConfusionMatrix::compute($labels, $hasil_prediksi));
		echo "</pre>";
	}

	public function cobaregresi2()
	{
		//tambahkan pengecekan login
        if(!isset($_SESSION['nama'])){
            return redirect()->to(base_url('home')); 
        }
		$samples = [[0], [8], [15], [22]];
		$targets = [32, 46.4, 15, 22]; //target data aktual

		$regression = new LeastSquares();
		$regression->train($samples, $targets); //prediksi
		$data['Prediksi'] = $regression->predict($samples);

		//parameter evaluasi
		echo "MSE Least Squares = ".Regression::meanSquaredError($targets, $data['Prediksi']);
		echo "<br>";
		echo "SLE  Least Squares = ".Regression::meanSquaredLogarithmicError($targets, $data['Prediksi']);
		echo "<br>";
		echo "MAE  Least Squares = ".Regression::meanAbsoluteError($targets, $data['Prediksi']);

		echo "<hr>";
		$regression = new SVR(Kernel::LINEAR);
		$regression->train($samples, $targets);
		echo "MSE SVR = ".Regression::meanSquaredError($targets, $regression->predict($samples));
		echo "<br>";
		echo "SLE  SVR = ".Regression::meanSquaredLogarithmicError($targets, $regression->predict($samples));
		echo "<br>";
		echo "MAE  SVR = ".Regression::meanAbsoluteError($targets, $regression->predict($samples));


	}

}
