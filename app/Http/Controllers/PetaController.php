<?php

namespace App\Http\Controllers;
use App\Models\JenisLokasi;
use App\Http\Requests\CreatePetaRequest;
use App\Http\Requests\UpdatePetaRequest;
use App\Repositories\PetaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PetaController extends AppBaseController
{
    /** @var PetaRepository $petaRepository*/
    private $petaRepository;

    public function __construct(PetaRepository $petaRepo)
    {
        $this->petaRepository = $petaRepo;
    }

    /**
     * Display a listing of the Peta.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $petas = $this->petaRepository->all();
        $jenisLokasi = JenisLokasi::all();

        return view('petas.index', compact('jenisLokasi', 'petas'));
    }

    /**
     * Show the form for creating a new Peta.
     *
     * @return Response
     */
    public function create()
    {
        $jenisLokasi = JenisLokasi::all();

        return view('petas.create', compact('jenisLokasi'));
    }

    /**
     * Store a newly created Peta in storage.
     *
     * @param CreatePetaRequest $request
     *
     * @return Response
     */
    public function store(CreatePetaRequest $request)
    {
        $input = $request->all();

        $peta = $this->petaRepository->create($input);

        Flash::success('Peta saved successfully.');

        return redirect(route('petas.index'));
    }

    /**
     * Display the specified Peta.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $peta = $this->petaRepository->find($id);

        if (empty($peta)) {
            Flash::error('Peta not found');

            return redirect(route('petas.index'));
        }

        return view('petas.show')->with('peta', $peta);
    }

    /**
     * Show the form for editing the specified Peta.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $peta = $this->petaRepository->find($id);
        $jenisLokasi = JenisLokasi::all();

        if (empty($peta)) {
            Flash::error('Peta not found');

            return redirect(route('petas.index'));
        }

        return view('petas.edit', compact('jenisLokasi'))->with('peta', $peta);
    }

    /**
     * Update the specified Peta in storage.
     *
     * @param int $id
     * @param UpdatePetaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePetaRequest $request)
    {
        $peta = $this->petaRepository->find($id);

        if (empty($peta)) {
            Flash::error('Peta not found');

            return redirect(route('petas.index'));
        }

        $peta = $this->petaRepository->update($request->all(), $id);

        Flash::success('Peta updated successfully.');

        return redirect(route('petas.index'));
    }

    /**
     * Remove the specified Peta from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $peta = $this->petaRepository->find($id);

        if (empty($peta)) {
            Flash::error('Peta not found');

            return redirect(route('petas.index'));
        }

        $this->petaRepository->delete($id);

        Flash::success('Peta deleted successfully.');

        return redirect(route('petas.index'));
    }

}
